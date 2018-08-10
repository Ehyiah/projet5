<?php

namespace App\Tests\Domain\DTO;


use App\Domain\DTO\LoginDTO;
use PHPUnit\Framework\TestCase;

final class LoginDTOTest extends TestCase
{
    /**
     * @param string $username
     * @param string $password
     *
     * @dataProvider dataProvide
     */
    public function testItImplements(
        string $username,
        string $password
    ) {
        $dto = new LoginDTO(
            $username,
            $password
        );

        static::assertInstanceOf(LoginDTO::class, $dto);
        static::assertSame($username, $dto->username);
        static::assertSame($password, $dto->password);
    }

    /**
     * @return \Generator
     */
    public function dataProvide()
    {
        yield array(
          'username',
          'password'
        );
    }
}