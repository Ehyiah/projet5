<?php

namespace App\Domain\Builder;


use App\Domain\Builder\Interfaces\UserBuilderInterface;
use App\Entity\User;

class UserBuilder implements UserBuilderInterface
{
    private $user;

    public function createFromRegistration(string $username, string $password, string $email, callable $passwordEncoder): self
    {
        $this->user = new User($username, $password, $email, $passwordEncoder);

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }
}