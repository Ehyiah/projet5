<?php

namespace App\Entity\Interfaces;


interface UserInterface
{
    /**
     * @return bool
     */
    public function addRoleAdmin(): bool;
}