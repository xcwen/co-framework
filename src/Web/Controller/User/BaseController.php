<?php

namespace src\Web\Controller\User;

use Controller;

class BaseController extends Controller
{
    protected function getUser()
    {
        $userId = $this->container->getContext('userId', 0);
        $user = (yield service("user")->call("User\User::getUser", ['id' => $userId]));
        if ($user) {
            $this->container->singleton('twig')->addGlobal('app', ['userId' => $userId, 'user' => $user]);
        } else {
            $this->container->setContext('userId', 0);
        }
    }
}