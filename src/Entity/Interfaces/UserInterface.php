<?php

namespace App\Entity\Interfaces;


interface UserInterface
{
    /**
     * @param string $password
     *
     * @return string
     */
    public function editPassword(string $password): string;

    /**
     * @return bool
     */
    public function addRoleAdmin(): bool;
}
