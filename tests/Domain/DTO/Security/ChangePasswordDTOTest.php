<?php

namespace App\Tests\Domain\DTO\Security;


use App\Domain\DTO\Security\ChangePasswordDTO;
use PHPUnit\Framework\TestCase;

/**
 * Class ChangePasswordDTOTest
 * @group DTO
 */
final class ChangePasswordDTOTest extends TestCase
{
    /**
     * @param string $password
     * @param string $oldPassword
     *
     * @dataProvider provideData
     */
    public function testItImplements(
        string $password,
        string $oldPassword
    )
    {
        $dto = new ChangePasswordDTO(
            $password,
            $oldPassword
        );

        static::assertInstanceOf(ChangePasswordDTO::class, $dto);

        static::assertSame($password, $dto->password);
        static::assertSame($oldPassword, $dto->oldPassword);
    }

    /**
     * @return \Generator
     */
    public function provideData()
    {
        yield array(
            'motDePasse',
            'OldMotDePasse'
        );
        yield array(
            'motDePasse0',
            'OldMotDePasse0'
        );
    }
}
