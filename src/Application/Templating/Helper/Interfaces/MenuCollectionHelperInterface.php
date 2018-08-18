<?php

namespace App\Application\Templating\Helper\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

interface MenuCollectionHelperInterface
{
    /**
     * MenuCollectionHelperInterface constructor.
     *
     * @param TokenStorageInterface $security
     * @param CollectionRepositoryInterface $collectionRepository
     */
    public function __construct(
        TokenStorageInterface $security,
        CollectionRepositoryInterface $collectionRepository
    );

    /**
     * @return mixed
     */
    public function menuHelper();
}