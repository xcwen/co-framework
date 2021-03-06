<?php

namespace Group\Protocol;

use Config;

class DataPack 
{   
    protected static $pack = false;

    protected static $gzip = false;

    public static function pack($data)
    {   
        self::checkConfig();

        switch (self::$pack) {
            case 'serialize':
                $data = serialize($data);
                break;
            case 'json':
            default:
                $data = json_encode($data);
                break;
        }

        if (self::$gzip) {
            if (strlen($data) > 4096) {
                return gzdeflate($data, 6);
            } else {
                return gzdeflate($data, 0);
            }
        } else {
            return $data;
        }
    }

    public static function unpack($data)
    {
        self::checkConfig();

        if (self::$gzip) {
            $data = gzinflate($data);
        }

        switch (self::$pack) {
            case 'serialize':
                return unserialize($data);
            case 'json':
            default:
                return json_decode($data, true);
        }
    }

    public static function checkConfig()
    {
        if (!self::$pack) {
            self::$pack = Config::get("app::pack");
        }

        if (!self::$gzip) {
            self::$gzip = Config::get("app::gzip");
        }
    }
}