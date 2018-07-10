<?php

namespace App\Controller\Collection;


use App\Entity\Collection;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DeleteCollectionAction
 * @package App\Controller\Collection
 * @Route("/delete/collection/{id}", name="deleteCollection")
 * @Security("has_role('ROLE_USER')")
 */
class DeleteCollectionAction
{
    /**
     * @var CollectionRepositoryInterface
     */
    private $collectionRepository;

    /**
     * DeleteCollectionAction constructor.
     *
     * @param CollectionRepositoryInterface $collectionRepository
     */
    public function __construct(CollectionRepositoryInterface $collectionRepository)
    {
        $this->collectionRepository = $collectionRepository;
    }

    public function __invoke(Collection $collection, $id)
    {
        $collection = $this->collectionRepository->find($id);

        $this->collectionRepository->remove($collection);
    }
}