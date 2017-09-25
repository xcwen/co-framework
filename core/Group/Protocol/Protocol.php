<?php

namespace Group\Protocol;

use Config;
use Group\Protocol\DataPack;

class Protocol
{
    protected static $packageEof = "\r\n";

    protected static $protocol = false;

    public static function pack($data = [])
    {
        if (!self::$protocol) {
            self::$protocol = Config::get("app::protocol");
        }

        switch (self::$protocol) {
            case 'buf':
                $body = pack("a*", DataPack::pack($data));
                $bodyLen = strlen($body);
                $head = pack("N", $bodyLen);
                return $head . $body;
            case 'eof':
                return DataPack::pack($data).self::$packageEof;
            default:
                return DataPack::pack($data);
        }
    }

    public static function unpack($data = [])
    {
        return DataPack::unpack($data);
    }
}