<?php

namespace Group\Protocol\Client;

use Group\Async\Client\Tcp as TcpClient;

class Tcp extends TcpClient
{
    public function parse($data)
    {   
        return $data;
    }
}