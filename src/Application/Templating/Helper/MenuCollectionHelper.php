<?php

namespace App\Application\Templating\Helper;


use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class MenuCollectionHelper extends \Twig_Extension
{
    /**
     * @var TokenStorageInterface
     */
    private $security;

    /**
     * @var CollectionRepositoryInterface
     */
    private $collectionRepository;

    /**
     * MenuCollectionHelper constructor.
     *
     * @param TokenStorageInterface $security
     * @param CollectionRepositoryInterface $collectionRepository
     */
    public function __construct(
        TokenStorageInterface $security,
        CollectionRepositoryInterface $collectionRepository
    ) {
        $this->security = $security;
        $this->collectionRepository = $collectionRepository;
    }


    public function menuHelper()
    {
        $user = $this->security->getToken()->getUser();
        $collection = $this->collectionRepository->menuFindByOwnerAndCategory($user);

        return $collection;
    }
}