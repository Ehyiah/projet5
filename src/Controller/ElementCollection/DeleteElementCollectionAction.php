<?php

namespace App\Controller\ElementCollection;


use App\Entity\ElementCollection;
use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DeleteElementCollectionAction
 * @package App\Controller\ElementCollection
 * @Route("/delete/element/{id}", name="deleteElement")
 * @Security("has_role('ROLE_USER')")
 */
class DeleteElementCollectionAction
{
    /**
     * @var ElementCollectionRepositoryInterface
     */
    private $elementRepository;

    /**
     * DeleteElementCollectionAction constructor.
     *
     * @param ElementCollectionRepositoryInterface $elementRepository
     */
    public function __construct(ElementCollectionRepositoryInterface $elementRepository)
    {
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
        $element = $this->elementRepository->find($id);

        foreach ($element->getImages() as $image) {
            $element->getImages()->removeElement($image);
        }

        $this->elementRepository->remove($element);

        return new RedirectResponse($request->headers->get('referer'));
    }
}