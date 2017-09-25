<?php

namespace src\Service\User\Service\Rely;

use Group\Sync\Service;

abstract class UserBaseService extends Service
{
    /**
     * @return src\Service\User\Dao\Impl\UserDaoImpl
     */
    public function getUserDao()
    {
        return $this->createDao("User:User");
    }
}