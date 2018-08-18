<?php

namespace App\Controller\ElementCollection\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use App\UI\Responder\Collection\Interfaces\ShowCollectionDetailledResponderInterface;
use Symfony\Component\HttpFoundation\Request;

interface ShowCollectionDetailledActionInterface
{
    /**
     * ShowCollectionDetailledActionInterface constructor.
     *
     * @param ElementCollectionRepositoryInterface $elementCollectionRepository
     */
    public function __construct(ElementCollectionRepositoryInterface $elementCollectionRepository);

    /**
     * @param Request $request
     * @param ShowCollectionDetailledResponderInterface $responder
     * @param $idCollection
     *
     * @return mixed
     */
    public function __invoke(
        Request $request,
        ShowCollectionDetailledResponderInterface $responder,
        $idCollection
    );
}