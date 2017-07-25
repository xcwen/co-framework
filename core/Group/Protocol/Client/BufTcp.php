<?php

namespace Group\Protocol\Client;

use Group\Async\Client\Tcp;

class BufTcp extends Tcp
{
    protected $setting = [];

    public function __construct($ip, $port)
    {
        $this->setting = [
            'open_length_check' => true,
            'package_length_type' => 'N',
            'package_max_length' => 2000000,
            'package_length_func' => function ($data) {
                if (strlen($data) < 4) {
                    return 0;
                }
                $length = substr($data, 0, 4);
                $data = unpack('Nlen', $length);
                if ($data['len'] <= 0) {
                    return -1;
                }
                return $data['len'] + 4;
            }
        ];

        parent::__construct($ip, $port);
    }

    public function parse($data)
    {
        return substr($data, 4);
    }
}