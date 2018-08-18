<?php

namespace App\Controller\Collection;


use App\Controller\Collection\Interfaces\DeleteImageFromCollectionInterface;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\ImageRepositoryInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DeleteImageFromCollection
 * @Route("/deleteImageFromCollection/{id}", name="deleteImage")
 * @Security("has_role('ROLE_USER')")
 */
class DeleteImageFromCollection implements DeleteImageFromCollectionInterface
{
    /**
     * @var CollectionRepositoryInterface
     */
    private $collectionRepository;

    /**
     * @var ImageRepositoryInterface
     */
    private $imageRepository;

    /**
     * DeleteImageFromCollection constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        CollectionRepositoryInterface $collectionRepository,
        ImageRepositoryInterface $imageRepository
    ) {
        $this->collectionRepository = $collectionRepository;
        $this->imageRepository = $imageRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(
        Request $request,
        $id
    ) {
        $image = $this->imageRepository->find($id);
        $this->collectionRepository->removeImage($image);

        $request->getSession()->getFlashBag()->add('success', 'L\'image a bien été supprimée');

        return new RedirectResponse($request->headers->get('referer'));
    }
}