<?php

namespace App\Controller\ElementCollection;

use App\Controller\ElementCollection\Interfaces\DeleteImageFromElementCollectionActionInterface;
use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\ImageRepositoryInterface;
use App\Repository\ElementCollectionRepository;
use App\Repository\ImageRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DeleteImageFromElementCollectionAction
 * @Route("/deleteImage/{id}/{idElement}", name="deleteImageFromCollection")
 * @IsGranted("ROLE_USER")
 */
class DeleteImageFromElementCollectionAction
{
    /**
     * @var ElementCollectionRepository
     */
    private $elementRepository;

    /**
     * @var ImageRepository
     */
    private $imageRepository;

    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * DeleteImageFromElementCollectionAction constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        ElementCollectionRepository $elementRepository,
        ImageRepository $imageRepository,
        Filesystem $filesystem
    ) {
        $this->elementRepository = $elementRepository;
        $this->imageRepository = $imageRepository;
        $this->filesystem = $filesystem;
    }


    /**
     * {@inheritdoc}
     */
    public function __invoke(
        Request $request,
        $idElement,
        $id
    ) {
        $image = $this->imageRepository->findImage($id);

        $this->filesystem->remove('../public/upload/CollectionImage/'.$image->getTitle());
        $this->elementRepository->removeImage($image);

        $request->getSession()->getFlashBag()->add('success', 'L\'image a bien été supprimée de l\'Element');

        return new RedirectResponse($request->headers->get('referer'));
    }
}
