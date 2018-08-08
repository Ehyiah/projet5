<?php

namespace App\Controller\Security;


use App\Controller\Security\Interfaces\MemberActionInterface;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\ImageRepositoryInterface;
use App\UI\Responder\MemberResponder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Twig\Environment;

/**
 * Class MemberAction
 * @package App\Controller
 * @Route("/member", name="member")
 * @Security("has_role('ROLE_USER')")
 */
class MemberAction implements MemberActionInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var ImageRepositoryInterface
     */
    private $imageRepository;

    /**
     * @var CollectionRepositoryInterface
     */
    private $collection;

    /**
     * @var TokenStorageInterface
     */
    private $security;


    /**
     * MemberAction constructor.
     *
     * @param Environment $twig
     * @param ImageRepositoryInterface $imageRepository
     * @param CollectionRepositoryInterface $collection
     * @param TokenStorageInterface $security
     */
    public function __construct(
        Environment $twig,
        ImageRepositoryInterface $imageRepository,
        CollectionRepositoryInterface $collection,
        TokenStorageInterface $security
    ) {
        $this->twig = $twig;
        $this->imageRepository = $imageRepository;
        $this->collection = $collection;
        $this->security = $security;
    }


    /**
     * @param Request $request
     * @param MemberResponder $responder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        Request $request,
        MemberResponder $responder
    ) {
        $user = $this->security->getToken()->getUser();

        $collections = $this->imageRepository->findAll();

        $collection = $this->collection->findByOwner($user);

        $tab[] = $user;
        $tab[] = $collections;
        $tab[] = $collection;

        dump($tab);
        //die();

        return $responder(false, $tab);
    }
}