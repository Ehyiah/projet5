<?php

namespace App\UI\Form\Handler\ElementCollection;


use App\Entity\ElementCollection;
use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use App\UI\Form\Handler\ElementCollection\Interfaces\EditElementCollectionHandlerInterface;
use Symfony\Component\Form\FormInterface;

/**
 * Class EditElementCollectionHandler
 */
final class EditElementCollectionHandler implements EditElementCollectionHandlerInterface
{
    /**
     * @var ElementCollectionRepositoryInterface
     */
    private $elementRepository;

    /**
     * EditElementCollectionHandler constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        ElementCollectionRepositoryInterface $elementRepository
    )
    {
        $this->elementRepository = $elementRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(FormInterface $form, ElementCollection $element) : bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $element->editElement($data);

            $this->elementRepository->edit($element);

            return true;
        }

        return false;
    }
}
