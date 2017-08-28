<?php

namespace Group\Async\Tests;

use Test;
use AsyncHttp;

class AsyncHttpTest extends Test
{
    public function unitget()
    {   
        $http = new AsyncHttp('127.0.0.1', 80);
        $http->setHost('groupco.com');
        $res = (yield $http->get('/'));
        // $this->assertEquals('200', $res->statusCode);
        // $this->assertEquals('hello world!', $res->body);
    }

    public function unitpost()
    {   
        $http = new AsyncHttp('54.222.154.77', 443, true);
        $http->setHost('www.clothesmake.com.cn');
        $res = (yield $http->post('/stylist/post/like', ['postId' => 52]));

        dump($res);
        // $this->assertEquals('200', $res->statusCode);
        // $this->assertEquals('hello world!', $res->body);
    }
}
