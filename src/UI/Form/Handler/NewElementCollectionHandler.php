<?php

namespace App\UI\Form\Handler;


use App\Entity\ElementCollection;
use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use App\UI\Form\Handler\Interfaces\NewElementCollectionHandlerInterface;
use Symfony\Component\Form\FormInterface;

class NewElementCollectionHandler implements NewElementCollectionHandlerInterface
{
    /**
     * @var ElementCollectionRepositoryInterface
     */
    private $elementCollection;

    /**
     * NewElementCollectionHandler constructor.
     *
     * @param ElementCollectionRepositoryInterface $collectionRepository
     */
    public function __construct(ElementCollectionRepositoryInterface $collectionRepository)
    {
        $this->elementCollection = $collectionRepository;
    }

    public function handle(FormInterface $form): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {

            $element = new ElementCollection($form->getData());
            $this->elementCollection->save($element);

            return true;
        }

        return false;
    }
}