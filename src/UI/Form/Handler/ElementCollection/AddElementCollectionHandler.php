<?php

namespace App\UI\Form\Handler\ElementCollection;


use App\Entity\ElementCollection;
use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use Symfony\Component\Form\FormInterface;

class AddElementCollectionHandler
{
    /**
     * @var ElementCollectionRepositoryInterface
     */
    private $elementCollection;

    /**
     * AddElementCollectionHandler constructor.
     *
     * @param ElementCollectionRepositoryInterface $elementCollection
     */
    public function __construct(ElementCollectionRepositoryInterface $elementCollection)
    {
        $this->elementCollection = $elementCollection;
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