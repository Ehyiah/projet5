<?php

namespace App\Domain\Builder\Interfaces;


interface UserBuilderInterface
{
    public function createFromRegistration(string $username, string $password, string $email, callable $passwordEncoder);
}