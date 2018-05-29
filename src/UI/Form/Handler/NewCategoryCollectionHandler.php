<?php

namespace App\UI\Form\Handler;


use App\Entity\CategoryCollection;
use App\Infra\Doctrine\Repository\CategoryCollectionRepository;
use App\UI\Form\Handler\Interfaces\NewCategoryCollectionHandlerInterface;
use Symfony\Component\Form\FormInterface;

class NewCategoryCollectionHandler implements NewCategoryCollectionHandlerInterface
{
    /**
     * @var CategoryCollectionRepository
     */
    private $categoryCollection;

    /**
     * NewCategoryCollectionHandler constructor.
     *
     * @param CategoryCollectionRepository $categoryCollectionRepository
     */
    public function __construct(CategoryCollectionRepository $categoryCollectionRepository)
    {
        $this->categoryCollection = $categoryCollectionRepository;
    }

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