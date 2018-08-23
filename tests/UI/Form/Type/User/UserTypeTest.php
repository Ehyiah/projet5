<?php

namespace App\Tests\UI\Form\Type\User;


use App\Domain\DTO\Security\AddUserDTO;
use App\UI\Form\Type\User\UserType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * Class UserTypeTest
 * @group Type
 */
final class UserTypeTest extends TypeTestCase
{
    public function testItImplements()
    {
        $type = new UserType();

        static::assertInstanceOf(AbstractType::class, $type);
        static::assertInstanceOf(UserType::class, $type);
    }

    /**
     * @param string $username
     * @param string $password
     * @param string $email
     *
     * @dataProvider provideData
     */
    public function testGoodData(
        string $username,
        string $password,
        string $email
    ) {
        $type = $this->factory->create(UserType::class);

        $type->submit([
           'username' => $username,
           'password' => [
               'first' => $password,
               'second' => $password
           ],
            'email' => $email
        ]);

        static::assertTrue($type->isValid());
        static::assertTrue($type->isSubmitted());
        static::assertInstanceOf(AddUserDTO::class, $type->getData());
        static::assertSame($username, $type->getData()->username);
        static::assertSame($password, $type->getData()->password);
        static::assertSame($email, $type->getData()->email);
    }

    /**
     * @return \Generator
     */
    public function provideData()
    {
        yield array('username', 'password', 'emmail@test.fr');
        yield array('username0', 'password0', 'emmail0@test.fr');
        yield array('username1', 'password1', 'emmail1@test.fr');
    }
}
