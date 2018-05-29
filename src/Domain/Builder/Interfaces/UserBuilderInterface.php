<?php

namespace App\Domain\Builder\Interfaces;


interface UserBuilderInterface
{
    /**
     * @param $username
     * @param $email
     * @param $password
     * @return mixed
     */
    public function createFromRegistration($username, $password, $email);
}