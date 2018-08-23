<?php

namespace App\Tests\UI\Form\Handler\Collection;


use App\Domain\DTO\Collection\EditCollectionDTO;
use App\Entity\CategoryCollection;
use App\Entity\Collection;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\UI\Form\Handler\Collection\EditCollectionHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;

/**
 * Class EditCollectionHandlerTest
 * @group Handler
 */
final class EditCollectionHandlerTest extends TestCase
{
    /**
     * @var CollectionRepositoryInterface
     */
    private $collectionRepository;

    protected function setUp()
    {
        $this->collectionRepository = $this->createMock(CollectionRepositoryInterface::class);
    }

    public function testItImplements()
    {
        $handler = new EditCollectionHandler($this->collectionRepository);

        static::assertInstanceOf(EditCollectionHandler::class, $handler);
    }

    public function testGoodHandling()
    {
        $category = $this->createMock(CategoryCollection::class);
        $editCollectionDTO = new EditCollectionDTO(
            'nom', 'tag', $category, true, null
        );
        $collection = $this->createMock(Collection::class);

        $form = $this->createMock(FormInterface::class);
        $form->method('getData')->willReturn($editCollectionDTO);
        $form->method('isValid')->willReturn(true);
        $form->method('isSubmitted')->willReturn(true);

        $handler = new EditCollectionHandler($this->collectionRepository);

        static::assertTrue($handler->handle($form, $collection));
    }
}
