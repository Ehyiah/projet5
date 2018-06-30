<?php

namespace App\Controller\Collection;

use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use App\UI\Responder\Collection\ShowCollectionDetailledResponder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ShowCollectionDetailledAction
 * @package App\Controller\Collection
 * @Route("/show/{idCollection}/{collectionName}", name="showDetailled")
 * @Security("has_role('ROLE_USER')")
 */
class ShowCollectionDetailledAction
{
    /**
     * @var ElementCollectionRepositoryInterface
     */
    private $elementCollectionRepository;

    /**
     * ShowCollectionDetailledAction constructor.
     *
     * @param ElementCollectionRepositoryInterface $elementCollectionRepository
     */
    public function __construct(ElementCollectionRepositoryInterface $elementCollectionRepository)
    {
        $this->elementCollectionRepository = $elementCollectionRepository;
    }


    /**
     * @param Request $request
     * @param ShowCollectionDetailledResponder $responder
     * @param $idCollection
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        Request $request,
        ShowCollectionDetailledResponder $responder,
        $idCollection
    ) {
        $collection = $this->elementCollectionRepository->findCollectionById($idCollection);

        if ($collection == null) {
            return $responder(true);
        }

        return $responder(false, $collection);
    }
}