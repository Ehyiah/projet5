<?php

namespace App\Controller\Collection;

use App\Controller\Collection\Interfaces\ShowCollectionActionInterface;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\UI\Responder\Collection\ShowCollectionResponder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class ShowCollectionAction
 * @Route("/show/{id}", name="show")
 * @IsGranted("ROLE_USER")
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
     * {@inheritdoc}
     */
    public function __construct(
        CollectionRepositoryInterface $collectionRepository,
        TokenStorageInterface $security
    ) {
        $this->collectionRepository = $collectionRepository;
        $this->security = $security;
    }


    /**
     * {@inheritdoc}
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        Request $request,
        ShowCollectionResponder $responder,
        $id = null
    ) {
        if (isset($id)) {
            $collections = $this->collectionRepository->findByOwnerAndCategory(
                $this->security->getToken()->getUser(),
                $id
            );

            return $responder(false, $collections);
        }

        else {
            return $responder(true);
        }
    }
}
