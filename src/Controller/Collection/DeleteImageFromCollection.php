<?php

namespace App\Controller\Collection;

use App\Controller\Collection\Interfaces\DeleteImageFromCollectionInterface;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\ImageRepositoryInterface;
use App\Repository\CollectionRepository;
use App\Repository\ImageRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DeleteImageFromCollection
 * @Route("/deleteImageFromCollection/{id}", name="deleteImage")
 * @IsGranted("ROLE_USER")
 */
class DeleteImageFromCollection
{
    /**
     * @var CollectionRepository
     */
    private $collectionRepository;

    /**
     * @var ImageRepository
     */
    private $imageRepository;

    /**
     * DeleteImageFromCollection constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        CollectionRepository $collectionRepository,
        ImageRepository $imageRepository
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
        $image = $this->imageRepository->findImage($id);
        $this->collectionRepository->removeImage($image);

        $request->getSession()->getFlashBag()->add('success', 'L\'image a bien été supprimée');

        return new RedirectResponse($request->headers->get('referer'));
    }
}
