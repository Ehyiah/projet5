<?php

namespace App\UI\Form\Handler\Collection;


use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\UI\Form\Handler\Collection\Interfaces\SelectCollectionHandlerInterface;
use Symfony\Component\Form\FormInterface;

class SelectCollectionHandler implements SelectCollectionHandlerInterface
{
    /**
     * @var CollectionRepositoryInterface
     */
    private $collections;

    /**
     * SelectCollectionHandler constructor.
     *
     * @param CollectionRepositoryInterface $collections
     */
    public function __construct(CollectionRepositoryInterface $collections)
    {
        $this->collections = $collections;
    }


    public function handle(FormInterface $form)
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $form->getData()->categoryCollection;

            return true;
        }

        return false;
    }
}