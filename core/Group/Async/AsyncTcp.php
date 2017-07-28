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

    public function __construct($serv, $port)
    {   
        $this->serv = $serv;
        $this->port = $port;
    }

    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
    }

    public function call($data = [], $timeout = false, $monitor = true)
    {   
        if (!$this->serv || !$this->port) {
            yield false;
        }
        
        if (is_numeric($timeout)) {
            $this->timeout = $timeout;
        }

        $data = Protocol::pack($data);
        
        $client = new Tcp($this->serv, $this->port);
        $client->setTimeout($this->timeout);
        $client->setData($data);
        $res = (yield $client);

        if ($res && $res['response']) {
            if ($monitor) {
                $container = (yield getContainer());
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
