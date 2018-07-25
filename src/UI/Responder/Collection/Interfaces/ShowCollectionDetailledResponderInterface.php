<?php

namespace App\UI\Responder\Collection\Interfaces;


interface ShowCollectionDetailledResponderInterface
{
    public function __invoke(
        $redirect = false,
        $collection = null
    );
}