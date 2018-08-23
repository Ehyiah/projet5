<?php

namespace App\Tests\UI\Form\Handler\Collection;


use App\Domain\DTO\Collection\ShowCollectionDTO;
use App\Entity\CategoryCollection;
use App\Infra\Doctrine\Repository\Interfaces\CategoryCollectionRepositoryInterface;
use App\UI\Form\Handler\Collection\SelectCollectionHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;

/**
 * Class SelectCollectionhandlerTest
 * @group Handler
 */
final class SelectCollectionhandlerTest extends TestCase
{
    /**
     * @var CategoryCollectionRepositoryInterface
     */
    private $categoryRepository;

    protected function setUp()
    {
        $this->categoryRepository = $this->createMock(CategoryCollectionRepositoryInterface::class);
    }

    public function testItImplements()
    {
        $handler = new SelectCollectionHandler($this->categoryRepository);

        static::assertInstanceOf(SelectCollectionHandler::class, $handler);
    }

    public function testGoodHandling()
    {
        $handler = new SelectCollectionHandler($this->categoryRepository);

        $showCollectionDTO = new ShowCollectionDTO(
            $this->createMock(CategoryCollection::class)
        );

        $form = $this->createMock(FormInterface::class);
        $form->method('getData')->willReturn($showCollectionDTO);
        $form->method('isSubmitted')->willReturn(true);
        $form->method('isValid')->willReturn(true);

        static::assertTrue($handler->handle($form));
    }
}
