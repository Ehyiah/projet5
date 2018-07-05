<?php


namespace App\Controller\Collection;


use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Twig\Environment;

/**
 * Class MenuCollectionAction
 * @package App\Controller\Collection
 * @Route("/test", name="test")
 */
class MenuCollectionAction extends Controller
{
    /**
     * @var TokenStorageInterface
     */
    private $security;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var CollectionRepositoryInterface
     */
    private $collectionRepository;

    /**
     * MenuCollectionAction constructor.
     *
     * @param TokenStorageInterface $security
     * @param Environment $twig
     * @param CollectionRepositoryInterface $collectionRepository
     */
    public function __construct(
        TokenStorageInterface $security,
        Environment $twig,
        CollectionRepositoryInterface $collectionRepository
    ) {
        $this->security = $security;
        $this->twig = $twig;
        $this->collectionRepository = $collectionRepository;
    }

    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function getAllCollectionsForMenu()
    {
        $user = $this->security->getToken()->getUser();

        //$collections = $this->collectionRepository->findByOwner($user);
         $collections = $this->collectionRepository->menuFindByOwnerAndCategory($user);


        return $this->render('MenuCollection.html.twig', array(
           'collections' => $collections
        ));

        return $this->twig->render('MenuCollection.html.twig', array(
            'collections' => $collections
        ));
    }
}