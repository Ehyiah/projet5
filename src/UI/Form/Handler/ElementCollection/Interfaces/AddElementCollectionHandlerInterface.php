<?php

namespace App\UI\Form\Handler\ElementCollection\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use Symfony\Component\Form\FormInterface;

interface AddElementCollectionHandlerInterface
{
    /**
     * AddElementCollectionHandlerInterface constructor.
     *
     * @param ElementCollectionRepositoryInterface $elementCollection
     */
    public function __construct(ElementCollectionRepositoryInterface $elementCollection);

    /**
     * @param FormInterface $form
     *
     * @return bool
     */
    public function handle(FormInterface $form): bool;
}
