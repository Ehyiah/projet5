<?php

namespace App\Controller;


use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\ImageRepositoryInterface;
use App\UI\Responder\MemberResponder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * Class MemberAction
 * @package App\Controller
 * @Route("/member", name="member")
 * @Security("has_role('ROLE_USER')")
 */
class MemberAction
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
     * MemberAction constructor.
     *
     * @param Environment $twig
     * @param ImageRepositoryInterface $imageRepository
     * @param CollectionRepositoryInterface $collection
     */
    public function __construct(Environment $twig, ImageRepositoryInterface $imageRepository, CollectionRepositoryInterface $collection)
    {
        $this->twig = $twig;
        $this->imageRepository = $imageRepository;
        $this->collection = $collection;
    }


    /**
     * @param MemberResponder $responder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(MemberResponder $responder)
    {
        $collections = $this->imageRepository->findAll();


        return $responder(false, $collections);
    }
}