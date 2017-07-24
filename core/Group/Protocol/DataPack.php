<?php

namespace Group\Protocol;

use Config;

class DataPack 
{   
    protected static $pack = false;

    public static function pack($data)
    {   
        if (!self::$pack) {
            self::$pack = Config::get("app::pack");
        }

        switch (self::$pack) {
            case 'serialize':
                return serialize($data);
            case 'json':
            default:
                return json_encode($data);
        }
    }

    public static function unpack($data)
    {
        if (!self::$pack) {
            self::$pack = Config::get("app::pack");
        }

        switch (self::$pack) {
            case 'serialize':
                return unserialize($data);
            case 'json':
            default:
                return json_decode($data, true);
        }
    }
}