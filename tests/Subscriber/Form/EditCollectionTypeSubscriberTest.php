<?php

namespace App\Tests\Subscriber\Form;


use PHPUnit\Framework\TestCase;
use SebastianBergmann\CodeCoverage\Node\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

/**
 * Class EditCollectionTypeSubscriberTest
 * @group a
 */
final class EditCollectionTypeSubscriberTest extends TestCase
{
    /**
     * @var FormEvent
     */
    private $formEventMock = null;

    protected function setUp()
    {
        $this->formEventMock = $this->createMock(FormEvent::class);
    }

    public function testItReturns()
    {
        $eventPostSetData = FormEvents::POST_SET_DATA;
        $eventSubmit = FormEvents::SUBMIT;

        static::assertSame(
            FormEvents::POST_SET_DATA,
            $eventPostSetData
        );
        static::assertSame(
            FormEvents::SUBMIT,
            $eventSubmit
        );
    }

    public function testOnPostSetData()
    {
        $image = $this->createMock(FileType::class);

        $this->formEventMock->method('getData')->willReturn($image);

        static::assertInstanceOf(
            FileType::class,
            $this->formEventMock->getData()
        );
    }

    public function testOnSubmit()
    {
        $fileTypeMock = $this->createMock(FileType::class);

        $eventMock = $this->createMock(FormEvent::class);
        $eventMock->method('getData')->willReturn($fileTypeMock);

    }
}
