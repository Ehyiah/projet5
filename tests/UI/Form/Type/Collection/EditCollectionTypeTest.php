<?php

namespace App\Tests\UI\Form\Type\Collection;


use App\Subscriber\Form\EditCollectionTypeSubscriber;
use App\UI\Form\DataTransformer\ImageCollectionDataTransformer;
use App\UI\Form\Type\Collection\EditCollectionType;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * Class EditCollectionTypeTest
 * @group Type
 */
final class EditCollectionTypeTest extends TypeTestCase
{
    /**
     * @var ImageCollectionDataTransformer
     */
    private $imageCollectionDataTransformer;

    /**
     * @var EditCollectionTypeSubscriber
     */
    private $editCollectionTypeSubscriber;

    protected function setUp()
    {
        $this->imageCollectionDataTransformer = $this->createMock(ImageCollectionDataTransformer::class);
        $this->editCollectionTypeSubscriber = $this->createMock(EditCollectionTypeSubscriber::class);
    }

    public function testItImplements()
    {
        $type = new EditCollectionType(
            $this->imageCollectionDataTransformer,
            $this->editCollectionTypeSubscriber
        );

        static::assertInstanceOf(EditCollectionType::class, $type);
    }
}
