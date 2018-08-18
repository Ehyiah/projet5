<?php

namespace App\UI\Form\Handler\ElementCollection;


use App\Entity\ElementCollection;
use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use App\UI\Form\Handler\ElementCollection\Interfaces\AddElementCollectionHandlerInterface;
use Symfony\Component\Form\FormInterface;

/**
 * Class AddElementCollectionHandler
 */
final class AddElementCollectionHandler implements AddElementCollectionHandlerInterface
{
    /**
     * @var ElementCollectionRepositoryInterface
     */
    private $elementCollection;

    /**
     * AddElementCollectionHandler constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(ElementCollectionRepositoryInterface $elementCollection)
    {
        $this->elementCollection = $elementCollection;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
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
