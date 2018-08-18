<?php

namespace App\Entity\Interfaces;


use App\Domain\DTO\AddUserDTO;

interface UserInterface
{
    /**
     * UserInterface constructor.
     *
     * @param AddUserDTO $addUserDTO
     */
    public function __construct(AddUserDTO $addUserDTO);

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