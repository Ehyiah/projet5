<?php

namespace App\Tests\UI\Form\Type\User;


use App\Domain\DTO\Security\Interfaces\ChangePasswordFromEmailDTOInterface;
use App\UI\Form\Type\User\ChangePasswordFromEmailType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class ChangePasswordFromEmailTypeTest
 * @group Type
 */
final class ChangePasswordFromEmailTypeTest extends TypeTestCase
{
    /**
     * @var ValidatorInterface
     */
    private $validator = null;

    protected function getExtensions()
    {
        $this->validator = $this->createMock(ValidatorInterface::class);
        $this->validator->method('validate')
            ->will($this->returnValue(new ConstraintViolationList()));
        $this->validator->method('getMetaDataFor')
            ->will($this->returnValue(new ClassMetadata(Form::class)));

        return [new ValidatorExtension($this->validator)];
    }

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
