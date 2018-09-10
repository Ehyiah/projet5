<?php

namespace App\Entity\Interfaces;


use App\Entity\User;

interface UserInterface
{
    /**
     * @param string $password
     *
     * @return string
     */
    public function editPassword(string $password): string;

    /**
     * @param string $email
     *
     * @return string
     */
    public function editEmail(string $email): string;

    /**
     * @return bool
     */
    public function addRoleAdmin(): bool;

    /**
     * @return User
     */
    public function getUser(): User;
}
