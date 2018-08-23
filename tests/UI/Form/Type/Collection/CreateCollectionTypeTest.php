<?php

namespace App\Tests\UI\Form\Type\Collection;


use App\UI\Form\DataTransformer\ImageCollectionDataTransformer;
use App\UI\Form\Type\Collection\CreateCollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * Class CreateCollectionTypeTest
 * @group Type
 */
final class CreateCollectionTypeTest extends TypeTestCase
{
    /**
     * @var ImageCollectionDataTransformer
     */
    private $imageCollectionDataTransformer;

    protected function setUp()
    {
        $this->imageCollectionDataTransformer = $this->createMock(ImageCollectionDataTransformer::class);
    }

    public function testItImplements()
    {
        $type = new CreateCollectionType(
            $this->imageCollectionDataTransformer
        );

        static::assertInstanceOf(AbstractType::class, $type);
    }
}
