<?php

namespace App\Controller\Collection;


use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\ImageRepositoryInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DeleteImageFromCollection
 * @package App\Controller\Collection
 * @Route("/deleteImageFromCollection/{id}", name="deleteImage")
 * @Security("has_role('ROLE_USER')")
 */
class DeleteImageFromCollection
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
     * @param CollectionRepositoryInterface $collectionRepository
     * @param ImageRepositoryInterface $imageRepository
     */
    public function __construct(
        CollectionRepositoryInterface $collectionRepository,
        ImageRepositoryInterface $imageRepository
    ) {
        $this->collectionRepository = $collectionRepository;
        $this->imageRepository = $imageRepository;
    }

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