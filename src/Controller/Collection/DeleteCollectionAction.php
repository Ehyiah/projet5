<?php

namespace App\Controller\Collection;


use App\Controller\Collection\Interfaces\DeleteCollectionActionInterface;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DeleteCollectionAction
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
     * @var Filesystem
     */
    private $fileSystem;

    /**
     * DeleteCollectionAction constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        CollectionRepositoryInterface $collectionRepository,
        ElementCollectionRepositoryInterface $elementRepository,
        Filesystem $fileSystem
    ) {
        $this->collectionRepository = $collectionRepository;
        $this->elementRepository = $elementRepository;
        $this->fileSystem = $fileSystem;
    }


    /**
     * {@inheritdoc}
     */
    public function __invoke(
        Request $request,
        $id
    ) {
        $collection = $this->collectionRepository->find($id);

        foreach ($collection->getElementsCollection() as $item) {
            foreach ($item->getImages() as $image) {
                $this->fileSystem->remove('../public/upload/CollectionImage/'.$image->getTitle());
            }
            $collection->getElementsCollection()->removeElement($item);
        }

        if (!\is_null($collection->getImage())) {
            $this->fileSystem->remove('../public/upload/CollectionImage/'.$collection->getImage()->getTitle());
        }

        $this->collectionRepository->remove($collection);


        $request->getSession()->getFlashBag()->add('success', 'La collection a bien été supprimée');

        return new RedirectResponse($request->headers->get('referer'));
    }
}