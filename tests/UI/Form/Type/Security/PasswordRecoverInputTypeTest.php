<?php

namespace App\Tests\UI\Form\Type\Security;


use App\Domain\DTO\Security\Interfaces\PasswordRecoverInputDTOInterface;
use App\UI\Form\Type\Security\PasswordRecoverInputType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * Class PasswordRecoverInputTypeTest
 * @group Type
 */
final class PasswordRecoverInputTypeTest extends TypeTestCase
{
    public function testItImplements()
    {
        $type = new PasswordRecoverInputType();

        static::assertInstanceOf(AbstractType::class, $type);
        static::assertInstanceOf(PasswordRecoverInputType::class, $type);
    }

    /**
     * @param string $name
     *
     * @dataProvider provideData
     */
    public function testGoodData(string $name)
    {
        $type = $this->factory->create(PasswordRecoverInputType::class);

        $type->submit([
           'name' => $name
        ]);

        static::assertTrue($type->isValid());
        static::assertTrue($type->isSubmitted());
        static::assertInstanceOf(PasswordRecoverInputDTOInterface::class, $type->getData());
        static::assertSame($name, $type->getData()->name);
    }

    public function provideData()
    {
        yield array('name');
        yield array('name0');
        yield array('name1');
    }
}
