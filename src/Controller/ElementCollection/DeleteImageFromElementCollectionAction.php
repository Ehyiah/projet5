<?php

namespace App\Controller\ElementCollection;


use App\Controller\ElementCollection\Interfaces\DeleteImageFromElementCollectionActionInterface;
use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\ImageRepositoryInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DeleteImageFromElementCollectionAction
 * @package App\Controller\ElementCollection
 * @Route("/deleteImage/{id}/{idElement}", name="deleteImageFromCollection")
 * @Security("has_role('ROLE_USER')")
 */
class DeleteImageFromElementCollectionAction implements DeleteImageFromElementCollectionActionInterface
{
    /**
     * @var ElementCollectionRepositoryInterface
     */
    private $elementRepository;

    /**
     * @var ImageRepositoryInterface
     */
    private $imageRepository;

    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * DeleteImageFromElementCollectionAction constructor.
     *
     * @param ElementCollectionRepositoryInterface $elementRepository
     * @param ImageRepositoryInterface $imageRepository
     * @param Filesystem $filesystem
     */
    public function __construct(
        ElementCollectionRepositoryInterface $elementRepository,
        ImageRepositoryInterface $imageRepository,
        Filesystem $filesystem
    ) {
        $this->elementRepository = $elementRepository;
        $this->imageRepository = $imageRepository;
        $this->filesystem = $filesystem;
    }


    public function __invoke(
        Request $request,
        $idElement,
        $id
    ) {
        $image = $this->imageRepository->find($id);

        $this->filesystem->remove('../public/upload/CollectionImage/'.$image->getTitle());
        $this->elementRepository->removeImage($image);

        $request->getSession()->getFlashBag()->add('success', 'L\'image a bien été supprimée de l\'Element');

        return new RedirectResponse($request->headers->get('referer'));
    }
}