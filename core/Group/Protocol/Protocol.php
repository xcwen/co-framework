<?php

namespace Group\Protocol;

use Config;

class Protocol 
{   
    protected static $protocol = false;

    public static function pack($cmd = '', $data = [])
    {   
        if ($cmd == '' && is_string($data)) {
            return $data;
        }

        if (!self::$protocol) {
            self::$protocol = Config::get("app::protocol");
        }

        switch (self::$protocol) {
            case 'buf':
                $body = pack("a*", serialize(['cmd' => $cmd, 'data' => $data]));
                $bodyLen = strlen($body);
                $head = pack("N", $bodyLen);
                return $head . $body;
            case 'eof':
            default:
                return json_encode(['cmd' => $cmd, 'data' => $data]);
        }
    }

    public static function unpack($data = [])
    {   
        if (!self::$protocol) {
            self::$protocol = Config::get("app::protocol");
        }

        switch (self::$protocol) {
            case 'buf':
                $data = unserialize($data);
                return [$data['cmd'], $data['data']];
            case 'eof':
            default:
                $data = json_decode($data, true);
                return [$data['cmd'], $data['data']];
        }
    }
}