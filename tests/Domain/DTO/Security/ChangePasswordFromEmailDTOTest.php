<?php

namespace App\Tests\Domain\DTO\Security;


use App\Domain\DTO\Security\ChangePasswordFromEmailDTO;
use PHPUnit\Framework\TestCase;

/**
 * Class ChangePasswordFromEmailDTOTest
 * @group DTO
 */
final class ChangePasswordFromEmailDTOTest extends TestCase
{
    /**
     * @param string $password
     * @param string $token
     *
     * @dataProvider dataProvide
     */
    public function testItImplements(string $password, string $token)
    {

        $dto = new ChangePasswordFromEmailDTO(
            $password,
            $token
        );

        static::assertInstanceOf(ChangePasswordFromEmailDTO::class, $dto);
    }

    /**
     * @return \Generator
     */
    public function dataProvide()
    {
        yield array(
            'pass',
            'token'
        );
        yield array(
            'pass2',
            'token2'
        );
    }
}
