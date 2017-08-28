<?php

namespace Group\Async;

use Config;
use \Group\Async\Client\Http;

class AsyncHttp
{   
    protected $serv;

    protected $port;

    protected $ssl;

    protected $timeout = 3;

    protected $keepalive = false;

    protected $data = [];

    protected $cookies = [];

    protected $headers = [
        "User-Agent" => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36',
        'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
        'Accept-Encoding' => 'gzip, deflate'
    ];

    public function __construct($serv, $port, $ssl = false)
    {   
        $this->serv = $serv;
        $this->port = $port;
        $this->ssl = $ssl;
    }

    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
    }

    public function setKeepalive($keepalive)
    {
        $this->keepalive = $keepalive;
    }

    public function setCookies(array $cookies)
    {
        $this->cookies = $cookies;
    }

    public function setHost($host)
    {
        $this->headers['Host'] = $host;
    }

    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }

    public function getClient()
    {
        $client = new Http($this->serv, $this->port, $this->ssl);
        $client->setTimeout($this->timeout);
        $client->setKeepalive($this->keepalive);
        $client->setCookies($this->cookies);
        $client->setHeaders($this->headers);

        return $client;
    }

    public function get($path)
    {
        $client = $this->getClient();
        $client->setMethod("GET");
        $client->setPath($path);

        $res = (yield $client);
        if ($res && $res['response']) {
            yield $res['response'];
        }

        yield false;
    }

    public function post($path, $data)
    {
        $this->headers['Content-Type'] = "application/x-www-form-urlencoded;charset=UTF-8";
        $client = $this->getClient();
        $client->setMethod("POST");
        $client->setPath($path);
        $client->setData(http_build_query($data));

        $res = (yield $client);
        if ($res && $res['response']) {
            yield $res['response'];
        }

        yield false;
    }
}
