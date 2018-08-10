<?php

namespace App\Tests\Domain\DTO;


use App\Domain\DTO\AddUserDTO;
use PHPUnit\Framework\TestCase;

final class AddUserDTOTest extends TestCase
{
    /**
     * @param string $username
     * @param string $password
     * @param string $email
     *
     * @dataProvider dataProvide
     */
    public function testItImplements(
        string $username,
        string $password,
        string $email
    ) {
        $dto = new AddUserDTO(
            $username,
            $password,
            $email
        );

        static::assertInstanceOf(AddUserDTO::class, $dto);
        static::assertSame($username, $dto->username);
        static::assertSame($password, $dto->password);
        static::assertSame($email, $dto->email);

    }

    /**
     * @return \Generator
     */
    public function dataProvide()
    {
        yield array(
            'username',
            'password',
            'email'
        );
        yield array(
            'username0',
            'password0',
            'email0'
        );
    }
}