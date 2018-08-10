<?php

namespace App\Controller\Security\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\ImageRepositoryInterface;
use App\UI\Responder\MemberResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Twig\Environment;

interface MemberActionInterface
{
    public function __construct(
        Environment $twig,
        ImageRepositoryInterface $imageRepository,
        CollectionRepositoryInterface $collection,
        TokenStorageInterface $security
    );

    public function __invoke(
        Request $request,
        MemberResponder $responder
    );
}