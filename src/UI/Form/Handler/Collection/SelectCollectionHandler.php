<?php

namespace App\UI\Form\Handler\Collection;


use App\Infra\Doctrine\Repository\Interfaces\CategoryCollectionRepositoryInterface;
use App\UI\Form\Handler\Collection\Interfaces\SelectCollectionHandlerInterface;
use Symfony\Component\Form\FormInterface;

class SelectCollectionHandler implements SelectCollectionHandlerInterface
{
    /**
     * @var CategoryCollectionRepositoryInterface
     */
    private $categoryRepository;

    /**
     * SelectCollectionHandler constructor.
     *
     * @param CategoryCollectionRepositoryInterface $categoryRepository
     */
    public function __construct(CategoryCollectionRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }


    public function handle(FormInterface $form)
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData()->categoryCollection;

            $this->categoryRepository->remove($category);

            return true;
        }

        return false;
    }
}