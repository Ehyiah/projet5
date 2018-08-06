<?php

namespace App\Controller\ElementCollection;


use App\Controller\ElementCollection\Interfaces\DeleteImageFromElementCollectionActionInterface;
use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\ImageRepositoryInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
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
     * DeleteImageFromElementCollectionAction constructor.
     *
     * @param ElementCollectionRepositoryInterface $elementRepository
     * @param ImageRepositoryInterface $imageRepository
     */
    public function __construct(ElementCollectionRepositoryInterface $elementRepository, ImageRepositoryInterface $imageRepository)
    {
        $this->elementRepository = $elementRepository;
        $this->imageRepository = $imageRepository;
    }


    public function __invoke(
        Request $request,
        $idElement,
        $id
    ) {
        $elementCollection = $this->elementRepository->find($idElement);
        $image = $this->imageRepository->find($id);

        dump($elementCollection->getImages());
        foreach ($elementCollection->getImages() as $img) {
            dump($img);
        }



        $elementCollection->removeImageFromCollection($image);

        dump($elementCollection);
        foreach ($elementCollection->getImages() as $img2) {
            dump($img2);
        }

        //die();

        return new RedirectResponse($request->headers->get('referer'));
    }
}