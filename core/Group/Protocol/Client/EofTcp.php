<?php

namespace Group\Protocol\Client;

use Group\Async\Client\Tcp;

class EofTcp extends Tcp
{
    protected $setting = [];

    public function __construct($ip, $port)
    {
        $this->setting = [
            //打开EOF检测
            'open_eof_check' => true, 
            //设置EOF 防止粘包
            'package_eof' => "\r\n", 
            'open_eof_split' => true, //底层拆分eof的包
        ];

        parent::__construct($ip, $port);
    }

    public function parse($data)
    {   
        $data = explode($this->setting['package_eof'], $data);
        return $data[0];
    }
}