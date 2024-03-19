<?php

namespace App\Application\Templating\Helper;


use App\Application\Templating\Helper\Interfaces\MenuCollectionHelperInterface;
use App\Repository\CollectionRepository;
use Symfony\Bundle\TwigBundle\DependencyInjection\TwigExtension;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class MenuCollectionHelper
 */
class MenuCollectionHelper extends TwigExtension
{
    /**
     * @var TokenStorageInterface
     */
    private $security;

    /**
     * @var CollectionRepository
     */
    private $collectionRepository;

    /**
     * MenuCollectionHelper constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        TokenStorageInterface $security,
        CollectionRepository $collectionRepository
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
