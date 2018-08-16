<?php

namespace App\Controller\Collection;


use App\Controller\Collection\Interfaces\ShowCollectionActionInterface;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\UI\Responder\Collection\ShowCollectionResponder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class ShowCollectionAction
 * @package App\Controller\Collection
 * @Route("/show/{id}", name="show")
 * @Security("has_role('ROLE_USER')")
 */
class ShowCollectionAction implements ShowCollectionActionInterface
{
    /**
     * @var CollectionRepositoryInterface
     */
    private $collectionRepository;

    /**
     * @var TokenStorageInterface
     */
    private $security;

    /**
     * ShowCollectionAction constructor.
     *
     * @param CollectionRepositoryInterface $collectionRepository
     * @param TokenStorageInterface $security
     */
    public function __construct(
        CollectionRepositoryInterface $collectionRepository,
        TokenStorageInterface $security
    ) {
        $this->collectionRepository = $collectionRepository;
        $this->security = $security;
    }


    /**
     * @param Request $request
     * @param ShowCollectionResponder $responder
     * @param null $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        Request $request,
        ShowCollectionResponder $responder,
        $id = null
    ) {
        /*
        if ($id == null) {
            $id = $_SESSION['ShowCollectionByCategory'];
        }
        */

        if (isset($id)) {
            $collections = $this->collectionRepository->findByOwnerAndCategory(
                $this->security->getToken()->getUser(),
                $id
            );

            return $responder(false, $collections);
        }

        else {
            return $responder(true, null);
        }
    }
}