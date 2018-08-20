<?php

namespace App\Tests\entity;


use App\Domain\DTO\Security\AddUserDTO;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testConstruct()
    {
        $userDTO = $this->createMock(AddUserDTO::class);
            $userDTO->username = 'username';
            $userDTO->email = 'email';
            $userDTO->password = 'password';

        $user = new User($userDTO);

        static::assertNotEmpty($user);

        static::assertSame('username', $user->getUsername());
        static::assertSame('email', $user->getEmail());
        static::assertSame('password', $user->getPassword());
    }
}