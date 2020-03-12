<?php

namespace App\Controller\ElementCollection;

use App\Controller\ElementCollection\Interfaces\DeleteElementCollectionActionInterface;
use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DeleteElementCollectionAction
 * @Route("/delete/element/{id}", name="deleteElement")
 * @IsGranted("ROLE_USER")
 */
class DeleteElementCollectionAction implements DeleteElementCollectionActionInterface
{
    /**
     * @var ElementCollectionRepositoryInterface
     */
    private $elementRepository;

    /**
     * @var Filesystem
     */
    private $fileSystem;

    /**
     * DeleteElementCollectionAction constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        ElementCollectionRepositoryInterface $elementRepository,
        Filesystem $fileSystem
    ) {
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
        $element = $this->elementRepository->find($id);

        foreach ($element->getImages() as $image) {
            $element->getImages()->removeElement($image);
            $this->fileSystem->remove('../public/upload/CollectionImage/'.$image->getTitle());
        }

        $this->elementRepository->remove($element);

        $request->getSession()->getFlashBag()->add('success', 'L\'élément a bien été supprimé');

        return new RedirectResponse($request->headers->get('referer'));
    }
}
