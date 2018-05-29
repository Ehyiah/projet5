<?php

namespace App\Domain\Builder;


use App\Domain\Builder\Interfaces\UserBuilderInterface;
use App\Entity\User;

class UserBuilder implements UserBuilderInterface
{
    private $user;

    /**
     * @param $username
     * @param $email
     * @param $password
     * @return $this|mixed
     */
    public function createFromRegistration($username, $email, $password)
    {
        $this->user = new User($username, $email, $password);

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }
}