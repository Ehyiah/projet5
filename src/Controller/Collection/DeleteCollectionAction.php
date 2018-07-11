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
        Collection $collection0,
        $id
    ) {
        $collection = $this->collectionRepository->find($id);

        dump($collection);

        foreach ($collection->getElementsCollection() as $item) {
            foreach ($item->getImages() as $image) {
                $item->getImages()->removeElement($image);
            }
            $collection->getElementsCollection()->removeElement($item);
        }

        die();
        $this->collectionRepository->remove($collection);

        return new RedirectResponse($request->headers->get('referer'));
    }




    public function temp()
    {
        $collection = $this->collectionRepository->find($id);

        foreach ($collection->getElementsCollection() as $elementCollection) {
            dump($elementCollection);
            foreach ($elementCollection->getImages() as $image) {
                dump($image);
                $elementCollection->getImages()->removeElement($image);
            }
            $collection->getElementsCollection()->removeElement($elementCollection);
        }

        $this->collectionRepository->remove($collection);

        return new RedirectResponse($request->headers->get('referer'));
    }
}