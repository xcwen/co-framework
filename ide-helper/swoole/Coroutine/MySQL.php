<?php
namespace Swoole\Coroutine;

/**
 * @since 2.0.9
 */
class MySQL
{

    private $serverInfo;
    public $sock;
    public $connected;
    public $connect_error;
    public $connect_errno;
    public $affected_rows;
    public $insert_id;
    public $error;
    public $errno;

    /**
     * @return mixed
     */
    public function __construct(){}

    /**
     * @return mixed
     */
    public function __destruct(){}

    /**
     * @param $server_config[required]
     * @return mixed
     */
    public function connect($server_config){}

    /**
     * @param $sql[required]
     * @param $timeout[optional]
     * @return mixed
     */
    public function query($sql, $timeout=null){}

    /**
     * @return mixed
     */
    public function recv(){}

    /**
     * @param $defer[optional]
     * @return mixed
     */
    public function setDefer($defer=null){}

    /**
     * @return mixed
     */
    public function getDefer(){}

    /**
     * @return mixed
     */
    public function close(){}


}
