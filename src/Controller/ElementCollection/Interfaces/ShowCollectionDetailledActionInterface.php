<?php

namespace App\Controller\ElementCollection\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use App\UI\Responder\Collection\ShowCollectionDetailledResponder;
use Symfony\Component\HttpFoundation\Request;

interface ShowCollectionDetailledActionInterface
{
    public function __construct(ElementCollectionRepositoryInterface $elementCollectionRepository);

    public function __invoke(
        Request $request,
        ShowCollectionDetailledResponder $responder,
        $idCollection
    );
}