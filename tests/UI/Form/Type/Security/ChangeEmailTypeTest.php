<?php

namespace App\Tests\UI\Form\Type\Security;


use App\Domain\DTO\Security\Interfaces\ChangeEmailDTOInterface;
use App\UI\Form\Type\Security\ChangeEmailType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * Class ChangeEmailTypeTest
 * @group Type
 */
final class ChangeEmailTypeTest extends TypeTestCase
{
    public function testItImplements()
    {
        $type = new ChangeEmailType();

        static::assertInstanceOf(ChangeEmailType::class, $type);
        static::assertInstanceOf(AbstractType::class, $type);
    }

    /**
     * @param string $email
     *
     * @dataProvider provideData
     */
    public function testTypeGoodData(string $email)
    {
        $type = $this->factory->create(ChangeEmailType::class);

        $type->submit([
            'email' => $email
        ]);

        static::assertTrue($type->isValid());
        static::assertTrue($type->isSubmitted());
        static::assertInstanceOf(ChangeEmailDTOInterface::class, $type->getData());
        static::assertSame($email, $type->getData()->email);
    }

    /**
     * @return \Generator
     */
    public function provideData()
    {
        yield array('email@email.fr');
        yield array('email0@email.fr');
        yield array('email1@email.fr');
        yield array('email2@email.fr');
    }
}
