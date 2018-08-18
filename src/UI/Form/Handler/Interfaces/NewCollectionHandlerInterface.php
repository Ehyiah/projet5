<?php

namespace App\UI\Form\Handler\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

interface NewCollectionHandlerInterface
{
    /**
     * NewCollectionHandlerInterface constructor.
     *
     * @param CollectionRepositoryInterface $collection
     * @param TokenStorageInterface $token
     */
    public function __construct(
        CollectionRepositoryInterface $collection,
        TokenStorageInterface $token
    );

    /**
     * @param FormInterface $form
     *
     * @return bool
     */
    public function handle(FormInterface $form) : bool;
}
