<?php

namespace App\Tests\UI\Form\Type\ElementCollection;


use App\UI\Form\Type\ElementCollection\AddElementCollectionFromCollectionType;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * Class AddElementCollectionFromCollectionTypeTest
 * @group Type
 */
final class AddElementCollectionFromCollectionTypeTest extends TypeTestCase
{
    public function testItImplements()
    {
        $type = new AddElementCollectionFromCollectionType();

        static::assertInstanceOf(AddElementCollectionFromCollectionType::class, $type);
    }
}
