<?php

namespace App\UI\Responder\Collection\Interfaces;


interface ShowCollectionResponderInterface
{
    public function __invoke(
        $redirect = false,
        $collections = null
    );
}