<?php

namespace App\Tests\UI\Form\Handler;


use App\Domain\DTO\Category\AddCategoryDTO;
use App\Infra\Doctrine\Repository\Interfaces\CategoryCollectionRepositoryInterface;
use App\UI\Form\Handler\NewCategoryCollectionHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;

/**
 * Class NewCategoryCollectionHandlerTest
 * @group Handler
 */
final class NewCategoryCollectionHandlerTest extends TestCase
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
        $handler = new NewCategoryCollectionHandler($this->categoryRepository);

        static::assertInstanceOf(NewCategoryCollectionHandler::class, $handler);
    }

    /**
     * @throws \Exception
     */
    public function testGoodhandling()
    {
        $categoryDTO = new AddCategoryDTO('catégorie');
        $form = $this->createMock(FormInterface::class);

        $form->method('getData')->willReturn($categoryDTO);
        $form->method('isSubmitted')->willReturn(true);
        $form->method('isValid')->willReturn(true);

        $handler = new NewCategoryCollectionHandler($this->categoryRepository);

        static::assertTrue($handler->handle($form));
    }
}
