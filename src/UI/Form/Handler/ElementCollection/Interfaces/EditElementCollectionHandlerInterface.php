<?php

namespace App\UI\Form\Handler\ElementCollection\Interfaces;


use App\Entity\ElementCollection;
use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use Symfony\Component\Form\FormInterface;

interface EditElementCollectionHandlerInterface
{
    /**
     * EditElementCollectionHandlerInterface constructor.
     *
     * @param ElementCollectionRepositoryInterface $elementRepository
     */
    public function __construct(ElementCollectionRepositoryInterface $elementRepository);

    /**
     * @param FormInterface $form
     * @param ElementCollection $element
     *
     * @return bool
     */
    public function handle(FormInterface $form, ElementCollection $element) : bool;
}
