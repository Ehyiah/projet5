<?php

namespace App\Tests\UI\Form\Type\User;


use App\Domain\DTO\Security\LoginDTO;
use App\UI\Form\Type\User\LoginType;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * Class LoginTypeTest
 * @group Type
 */
final class LoginTypeTest extends TypeTestCase
{
    public function testItImplements()
    {
        $type = new LoginType();

        static::assertInstanceOf(LoginType::class, $type);
    }

    /**
     * @param string $username
     * @param string $password
     *
     * @dataProvider provideData
     */
    public function testGoodData(string $username, string $password)
    {
        $type = $this->factory->create(LoginType::class);

        $type->submit([
            'username' => $username,
            'password' => $password
        ]);

        static::assertTrue($type->isValid());
        static::assertTrue($type->isSubmitted());
        static::assertInstanceOf(LoginDTO::class, $type->getData());
        static::assertSame($username, $type->getData()->username);
        static::assertSame($password, $type->getData()->password);
    }

    /**
     * @return \Generator
     */
    public function provideData()
    {
        yield array('user', 'password');
        yield array('user0', 'password0');
        yield array('user1', 'password1');
    }
}
