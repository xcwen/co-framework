<?php

namespace Group\Coroutine;

class SysCall {

    protected $callback;

    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    public function __invoke(Task $task)
    {

        mylog(" -- invoke ".json_encode($task));
        return call_user_func($this->callback, $task);
    }
}