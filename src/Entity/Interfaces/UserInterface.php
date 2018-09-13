<?php

namespace App\Entity\Interfaces;


use App\Entity\User;
use Ramsey\Uuid\UuidInterface;

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

    /**
     * @param $token
     *
     * @return mixed
     */
    public function newResetToken($token);

    /**
     * @return mixed
     */
    public function getRoles();

    /**
     * @return mixed
     */
    public function getPassword();

    /**
     * @return null|string|void
     */
    public function getSalt();

    /**
     * @return mixed
     */
    public function getUsername();

    public function eraseCredentials();

    public function serialize();

    public function unserialize($serialized);

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface;

    /**
     * @return \DateTime
     */
    public function getTokenValidity(): \DateTime;

    /**
     * @return string
     */
    public function getTokenReset(): string;

    /**
     * @return string
     */
    public function getEmail(): string;

    /**
     * @return \DateTime
     */
    public function getCreationDate(): \DateTime;
}
