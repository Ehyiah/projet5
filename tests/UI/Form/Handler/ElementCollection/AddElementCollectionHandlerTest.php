<?php

namespace App\Tests\UI\Form\Handler\ElementCollection;


use App\Domain\DTO\ElementCollection\AddElementCollectionDTO;
use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use App\UI\Form\Handler\ElementCollection\AddElementCollectionHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;

/**
 * Class AddElementCollectionHandlerTest
 * @group Handler
 */
final class AddElementCollectionHandlerTest extends TestCase
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
        $handler = new AddElementCollectionHandler($this->elementRepository);

        static::assertInstanceOf(AddElementCollectionHandler::class, $handler);
    }

    /**
     * @throws \Exception
     */
    public function testGoodHandling()
    {
        $handler = new AddElementCollectionHandler($this->elementRepository);

        $addElementDTO = new AddElementCollectionDTO();

        $form = $this->createMock(FormInterface::class);
        $form->method('getData')->willReturn($addElementDTO);
        $form->method('isValid')->willReturn(true);
        $form->method('isSubmitted')->willReturn(true);

        static::assertTrue($handler->handle($form));
    }
}
