<?php

namespace App\Tests\Domain\DTO\Security;


use App\Domain\DTO\Security\PasswordRecoverInputDTO;
use PHPUnit\Framework\TestCase;

final class PasswordRecoveryInputDTOTest extends TestCase
{
    /**
     * @param string $name
     *
     * @dataProvider dataProvide
     */
    public function testItImplements(string $name)
    {
        $dto = new PasswordRecoverInputDTO($name);

        static::assertInstanceOf(PasswordRecoverInputDTO::class, $dto);
        static::assertSame($name, $dto->name);
    }

    /**
     * @return \Generator
     */
    public function dataProvide()
    {
        yield array('nom');
        yield array('nom0');
        yield array('nom1');
    }
}