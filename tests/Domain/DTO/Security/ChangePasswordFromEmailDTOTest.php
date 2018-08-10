<?php

namespace App\Tests\Domain\DTO\Security;


use App\Domain\DTO\Security\ChangePasswordFromEmailDTO;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

final class ChangePasswordFromEmailDTOTest extends TestCase
{
    /**
     * @param PasswordType $password
     * @param string $token
     *
     * @dataProvider dataProvide
     */
    public function testItImplements(PasswordType $password, string $token)
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
        $pass = new PasswordType();

        yield array(
            $pass,
            'token'
        );
        yield array(
            $pass,
            'token2'
        );
    }
}