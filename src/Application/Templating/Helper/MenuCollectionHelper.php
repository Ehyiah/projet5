<?php

namespace App\Application\Templating\Helper;


use App\Application\Templating\Helper\Interfaces\MenuCollectionHelperInterface;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class MenuCollectionHelper
 */
class MenuCollectionHelper extends \Twig_Extension implements MenuCollectionHelperInterface
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
     * {@inheritdoc}
     */
    public function __construct(
        TokenStorageInterface $security,
        CollectionRepositoryInterface $collectionRepository
    ) {
        $this->security = $security;
        $this->collectionRepository = $collectionRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function menuHelper()
    {
        $user = $this->security->getToken()->getUser();
        $collection = $this->collectionRepository->menuFindByOwnerAndCategory($user);

        return $collection;
    }
}