<?php

namespace App\Controller\Collection;


use App\Controller\Collection\Interfaces\DeleteCollectionActionInterface;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
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
class DeleteCollectionAction implements DeleteCollectionActionInterface
{
    /**
     * @var CollectionRepositoryInterface
     */
    private $collectionRepository;

    /**
     * @var ElementCollectionRepositoryInterface
     */
    private $elementRepository;

    /**
     * DeleteCollectionAction constructor.
     *
     * @param CollectionRepositoryInterface $collectionRepository
     * @param ElementCollectionRepositoryInterface $elementRepository
     */
    public function __construct(
        CollectionRepositoryInterface $collectionRepository,
        ElementCollectionRepositoryInterface $elementRepository
    ) {
        $this->collectionRepository = $collectionRepository;
        $this->elementRepository = $elementRepository;
    }


    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function __invoke(
        Request $request,
        $id
    ) {
        $collection = $this->collectionRepository->find($id);
        //dump($collection->getImage());

        foreach ($collection->getElementsCollection() as $item) {

            $collection->getElementsCollection()->removeElement($item);
        }

        $this->collectionRepository->remove($collection);

        return new RedirectResponse($request->headers->get('referer'));
    }
}