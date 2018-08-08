<?php

namespace App\Controller\ElementCollection;


use App\Controller\ElementCollection\Interfaces\ShowCollectionDetailledActionInterface;
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
class ShowCollectionDetailledAction implements ShowCollectionDetailledActionInterface
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

        $request->getSession()->set('collectionName', $request->attributes->get('collectionName'));
        $request->getSession()->set('id', $request->attributes->get('idCollection'));

        if ($collection == null) {
            return $responder(true);
        }

        return $responder(false, $collection);
    }
}