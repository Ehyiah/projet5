<?php

namespace App\Tests\UI\Form\Type\Security;


use App\Domain\DTO\Security\Interfaces\ChangePasswordDTOInterface;
use App\UI\Form\Type\Security\ChangePasswordType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * Class ChangePasswordTypeTest
 * @group Type
 */
final class ChangePasswordTypeTest extends TypeTestCase
{
    public function testItImplements()
    {
        $type = new ChangePasswordType();

        static::assertInstanceOf(AbstractType::class, $type);
        static::assertInstanceOf(ChangePasswordType::class, $type);
    }

    /**
     * @param string $oldPassword
     * @param string $password
     *
     * @dataProvider provideData
     */
    public function testGoodData(
        string $oldPassword,
        string $password
    ) {
        $type = $this->factory->create(ChangePasswordType::class);

        $type->submit([
            'oldPassword' => $oldPassword,
            'password' => [
                'first' => $password,
                'second' => $password
            ]
        ]);

        static::assertTrue($type->isValid());
        static::assertTrue($type->isSubmitted());
        static::assertInstanceOf(ChangePasswordDTOInterface::class, $type->getData());
        static::assertSame($oldPassword, $type->getData()->oldPassword);
        static::assertSame($password, $type->getData()->password);
    }

    /**
     * @return \Generator
     */
    public function provideData()
    {
        yield array('pass', 'pass2');
        yield array('pass0', 'pass02');
        yield array('pass1', 'pass12');
    }
}
