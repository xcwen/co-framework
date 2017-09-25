<?php
namespace Swoole\Http;

/**
 * @since 2.0.9
 */
class Request
{

    public $fd;
    public $header;
    public $server;
    public $request;
    public $cookie;
    public $get;
    public $files;
    public $post;
    public $tmpfiles;

    /**
     * @return mixed
     */
    public function rawcontent(){}

    /**
     * @return mixed
     */
    public function __destruct(){}


}
