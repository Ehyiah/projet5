<?php

namespace App\UI\Form\Handler\Collection;


use App\Infra\Doctrine\Repository\Interfaces\CategoryCollectionRepositoryInterface;
use App\Repository\CategoryCollectionRepository;
use App\UI\Form\Handler\Collection\Interfaces\SelectCollectionHandlerInterface;
use Symfony\Component\Form\FormInterface;

/**
 * Class SelectCollectionHandler
 */
final class SelectCollectionHandler
{
    /**
     * @var CategoryCollectionRepository
     */
    private $categoryRepository;

    /**
     * SelectCollectionHandler constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(CategoryCollectionRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * {@inheritdoc}
     */
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
