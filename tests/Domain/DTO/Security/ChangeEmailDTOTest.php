<?php

namespace App\Tests\Domain\DTO\Security;


use App\Domain\DTO\Security\ChangeEmailDTO;
use PHPUnit\Framework\TestCase;

/**
 * Class ChangeEmailDTOTest
 * @group DTO
 */
class ChangeEmailDTOTest extends TestCase
{
    /**
     * @param string $email
     *
     * @dataProvider provideData
     */
    public function testItImplements(string $email)
    {
        $dto = new ChangeEmailDTO($email);

        static::assertInstanceOf(ChangeEmailDTO::class, $dto);
        static::assertSame($email, $dto->email);
    }

    /**
     * @return \Generator
     */
    public function provideData()
    {
        yield array('Email');
        yield array('Email0');
        yield array('Email1');
    }
}
