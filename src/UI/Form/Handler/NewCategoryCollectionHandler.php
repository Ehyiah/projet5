<?php

namespace App\UI\Form\Handler;


use App\Entity\CategoryCollection;
use App\Infra\Doctrine\Repository\Interfaces\CategoryCollectionRepositoryInterface;
use App\UI\Form\Handler\Interfaces\NewCategoryCollectionHandlerInterface;
use Symfony\Component\Form\FormInterface;

/**
 * Class NewCategoryCollectionHandler
 */
class NewCategoryCollectionHandler implements NewCategoryCollectionHandlerInterface
{
    /**
     * @var CategoryCollectionRepositoryInterface
     */
    private $categoryCollection;

    /**
     * NewCategoryCollectionHandler constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(CategoryCollectionRepositoryInterface $categoryCollectionRepository)
    {
        $this->categoryCollection = $categoryCollectionRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(FormInterface $form): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $category = new CategoryCollection($form->getData());
            $this->categoryCollection->save($category);

            return true;
        }

        return false;
    }
}
