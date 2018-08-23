<?php

namespace App\Tests\UI\Form\Type\ElementCollection;


use App\UI\Form\DataTransformer\ImageElementCollectionDataTransformer;
use App\UI\Form\Type\ElementCollection\NewElementCollectionType;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * Class NewElementCollectionTypeTest
 * @group Type
 */
final class NewElementCollectionTypeTest extends TypeTestCase
{
    /**
     * @var ImageElementCollectionDataTransformer
     */
    private $imageElementTransformer;

    protected function setUp()
    {
        $this->imageElementTransformer = $this->createMock(ImageElementCollectionDataTransformer::class);
    }

    public function testItImplements()
    {
        $type = new NewElementCollectionType(
            $this->imageElementTransformer
        );

        static::assertInstanceOf(NewElementCollectionType::class, $type);
    }
}