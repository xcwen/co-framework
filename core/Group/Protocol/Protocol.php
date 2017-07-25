<?php

namespace Group\Protocol;

use Config;
use Group\Protocol\DataPack;

class Protocol 
{   
    protected static $packageEof = "\r\n";

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
                $body = pack("a*", DataPack::pack(['cmd' => $cmd, 'data' => $data]));
                $bodyLen = strlen($body);
                $head = pack("N", $bodyLen);
                return $head . $body;
            case 'eof':
            default:
                return DataPack::pack(['cmd' => $cmd, 'data' => $data]).self::$packageEof;
        }
    }

    public static function unpack($data = [])
    {   
        $data = DataPack::unpack($data);
        return [$data['cmd'], $data['data']];
    }
}