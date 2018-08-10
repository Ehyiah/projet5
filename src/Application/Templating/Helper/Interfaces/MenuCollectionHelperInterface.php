<?php

namespace App\Application\Templating\Helper\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

interface MenuCollectionHelperInterface
{
    public function __construct(
        TokenStorageInterface $security,
        CollectionRepositoryInterface $collectionRepository
    );

    public function menuHelper();
}