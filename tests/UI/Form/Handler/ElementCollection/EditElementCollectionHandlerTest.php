<?php

namespace App\Tests\UI\Form\Handler\ElementCollection;


use App\Domain\DTO\ElementCollection\EditElementCollectionDTO;
use App\Entity\ElementCollection;
use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use App\UI\Form\Handler\ElementCollection\EditElementCollectionHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;

/**
 * Class EditElementCollectionHandlerTest
 * @group Handler
 */
final class EditElementCollectionHandlerTest extends TestCase
{
    /**
     * @var ElementCollectionRepositoryInterface
     */
    private $elementRepository;

    protected function setUp()
    {
        $this->elementRepository = $this->createMock(ElementCollectionRepositoryInterface::class);
    }

    public function testItImplements()
    {
        $handler = new EditElementCollectionHandler($this->elementRepository);

        static::assertInstanceOf(EditElementCollectionHandler::class, $handler);
    }

    public function testGoodHandling()
    {
        $handler = new EditElementCollectionHandler($this->elementRepository);

        $elementCollection = $this->createMock(ElementCollection::class);
        $editCollectionDTO = $this->createMock(EditElementCollectionDTO::class);

        $form = $this->createMock(FormInterface::class);
        $form->method('getData')->willReturn($editCollectionDTO);
        $form->method('isSubmitted')->willReturn(true);
        $form->method('isValid')->willReturn(true);

        static::assertTrue($handler->handle($form, $elementCollection));
    }
}
