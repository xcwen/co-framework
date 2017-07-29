<?php

namespace Group\Async;

use Group\Protocol\Client\Tcp;
use Group\Events\KernalEvent;
use Group\Protocol\DataPack;
use Group\Protocol\Protocol;
use Event;

class AsyncTcp
{   
    protected $serv;

    protected $port;

    protected $timeout = 5;

    protected $data = '';

    public function __construct($serv, $port)
    {   
        $this->serv = $serv;
        $this->port = $port;
    }

    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
    }

    public function call($data = '', $monitor = true)
    {   
        if (!$this->serv || !$this->port) {
            yield false;
        }

        $data = Protocol::pack($data);
        $res = (yield $this->request($data, $monitor));
        yield $res;
    }

    public function addCall($data = '')
    {   
        $data = Protocol::pack($data);

        $this->data = $this->data.$data;
    }

    public function multiCall($monitor = true)
    {   
        $res = (yield $this->request($this->data, $monitor));
        $this->data = '';
        yield $res;
    }

    public function request($data, $monitor)
    {   
        $container = (yield getContainer());
        $client = new Tcp($this->serv, $this->port);
        $client->setTimeout($this->timeout);
        $client->setData($data);
        $res = (yield $client);

        if ($res && $res['response']) {
            if ($monitor) {
                //抛出一个事件出去，方便做上报
                yield $container->singleton('eventDispatcher')->dispatch(KernalEvent::SERVICE_CALL, 
                    new Event(['calltime' => $res['calltime'], 'ip' => $this->serv,
                     'port' => $this->port, 'error' => $res['error']
                        ]));
            }

            yield $res['response'];
        }

        yield false;
    }
}
