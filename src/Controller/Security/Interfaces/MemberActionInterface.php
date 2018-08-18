<?php

namespace App\Controller\Security\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\ImageRepositoryInterface;
use App\UI\Responder\Interfaces\MemberResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Twig\Environment;

interface MemberActionInterface
{
    /**
     * MemberActionInterface constructor.
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
    );

    /**
     * @param Request $request
     * @param MemberResponderInterface $responder
     *
     * @return mixed
     */
    public function __invoke(
        Request $request,
        MemberResponderInterface $responder
    );
}