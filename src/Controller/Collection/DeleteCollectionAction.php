<?php

namespace App\Controller\Collection;


use App\Entity\Collection;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
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


    public function __invoke(
        Request $request,
        Collection $collection,
        $id
    ) {
        $collection = $this->collectionRepository->find($id);



        die();
        $this->collectionRepository->remove($collection);

        return new RedirectResponse($request->headers->get('referer'));
    }
}