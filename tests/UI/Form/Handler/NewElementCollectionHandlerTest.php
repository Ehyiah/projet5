<?php

namespace App\Tests\UI\Form\Handler;


use App\Domain\DTO\ElementCollection\AddElementCollectionDTO;
use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use App\UI\Form\Handler\NewElementCollectionHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;

/**
 * Class NewElementCollectionHandlerTest
 * @group Handler
 */
final class NewElementCollectionHandlerTest extends TestCase
{
    /**
     * @var ElementCollectionRepositoryInterface
     */
    private $elementCollection;

    protected function setUp()
    {
        $this->elementCollection = $this->createMock(ElementCollectionRepositoryInterface::class);
    }

    public function testItImplements()
    {
        $handler = new NewElementCollectionHandler(
            $this->elementCollection
        );

        static::assertInstanceOf(NewElementCollectionHandler::class, $handler);
    }

    /**
     * @throws \Exception
     */
    public function testGoodHandling()
    {
        $handler = new NewElementCollectionHandler(
            $this->elementCollection
        );

        $addElementDTO = $this->createMock(AddElementCollectionDTO::class);

        $form = $this->createMock(FormInterface::class);
        $form->method('getData')->willReturn($addElementDTO);
        $form->method('isSubmitted')->willReturn(true);
        $form->method('isValid')->willReturn(true);

        static::assertTrue($handler->handle($form));
    }
}
