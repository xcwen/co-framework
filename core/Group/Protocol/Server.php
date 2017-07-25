<?php

namespace Group\Protocol;

use Config;
use Group\Protocol\Server\BufServer;
use Group\Protocol\Server\EofServer;

class Server
{   
    protected $setting;

    public function __construct($config =[], $servName, $argv = [])
    {
        $protocol = Config::get("app::protocol");
        switch ($protocol) {
          case 'buf':
            $server = new BufServer($config, $servName, $argv);
            break;
          case 'eof':
          default:
            $server = new EofServer($config, $servName, $argv);
            break;
        }
    }
}