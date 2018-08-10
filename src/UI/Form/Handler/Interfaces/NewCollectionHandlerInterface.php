<?php

namespace App\UI\Form\Handler\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

interface NewCollectionHandlerInterface
{
    public function __construct(
        CollectionRepositoryInterface $collection,
        TokenStorageInterface $token
    );

    public function handle(FormInterface $form) : bool;
}