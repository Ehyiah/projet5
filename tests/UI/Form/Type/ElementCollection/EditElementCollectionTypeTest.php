<?php

namespace App\Tests\UI\Form\Type\ElementCollection;


use App\Subscriber\Form\EditElementCollectionTypeSubscriber;
use App\UI\Form\Type\ElementCollection\EditElementCollectionType;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * Class EditElementCollectionTypeTest
 * @group Type
 */
final class EditElementCollectionTypeTest extends TypeTestCase
{
    /**
     * @var EditElementCollectionTypeSubscriber
     */
    private $editElementCollectionTypeSubscriber;

    protected function setUp()
    {
        $this->editElementCollectionTypeSubscriber = $this->createMock(EditElementCollectionTypeSubscriber::class);
    }

    public function testItImplements()
    {
        $type = new EditElementCollectionType(
            $this->editElementCollectionTypeSubscriber
        );

        static::assertInstanceOf(EditElementCollectionType::class, $type);
    }
}