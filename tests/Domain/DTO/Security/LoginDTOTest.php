<?php

namespace App\Tests\Domain\DTO\Security;


use App\Domain\DTO\Security\LoginDTO;
use PHPUnit\Framework\TestCase;

/**
 * Class LoginDTOTest
 * @group DTO
 */
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
