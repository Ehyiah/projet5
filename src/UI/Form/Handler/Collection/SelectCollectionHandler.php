<?php

namespace App\UI\Form\Handler\Collection;


use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use Symfony\Component\Form\FormInterface;

class SelectCollectionHandler
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