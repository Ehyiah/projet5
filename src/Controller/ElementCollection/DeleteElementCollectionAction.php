<?php

namespace App\Controller\ElementCollection;


use App\Entity\ElementCollection;
use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
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


    public function __invoke(ElementCollection $elementCollection, $id)
    {
        $element = $this->elementRepository->find($id);

        $this->elementRepository->remove($element);
    }
}