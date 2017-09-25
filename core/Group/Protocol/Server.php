<?php

namespace Group\Protocol;

use Config;
use Group\Protocol\Server\BufServer;
use Group\Protocol\Server\EofServer;
use Group\Protocol\Server\Server as Serv;

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
            $server = new EofServer($config, $servName, $argv);
            break;
          default:
            $server = new Serv($config, $servName, $argv);
            break;
        }
    }
}