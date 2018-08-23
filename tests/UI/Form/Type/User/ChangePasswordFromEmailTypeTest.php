<?php

namespace App\Tests\UI\Form\Type\User;


use App\Domain\DTO\Security\Interfaces\ChangePasswordFromEmailDTOInterface;
use App\UI\Form\Type\User\ChangePasswordFromEmailType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * Class ChangePasswordFromEmailTypeTest
 * @group Type
 */
final class ChangePasswordFromEmailTypeTest extends TypeTestCase
{
    public function testItImplements()
    {
        $type = new ChangePasswordFromEmailType();

        static::assertInstanceOf(AbstractType::class, $type);
        static::assertInstanceOf(ChangePasswordFromEmailType::class, $type);
    }

    /**
     * @param string $password
     * @param string $token
     *
     * @dataProvider provideData
     */
    public function testGoodData(string $password, string $token)
    {
        $type = $this->factory->create(ChangePasswordFromEmailType::class);

        $type->submit([
            'password' => $password,
            'token' => $token
        ]);

        static::assertTrue($type->isSubmitted());
        static::assertTrue($type->isValid());
        static::assertInstanceOf(ChangePasswordFromEmailDTOInterface::class, $type->getData());
        static::assertSame($password, $type->getData()->password);
        static::assertSame($token, $type->getData()->token);
    }

    /**
     * @return \Generator
     */
    public function provideData()
    {
        yield array('password', 'token');
        yield array('password0', 'token0');
    }
}
