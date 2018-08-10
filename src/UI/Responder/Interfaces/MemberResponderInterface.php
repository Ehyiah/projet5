<?php

namespace App\UI\Responder\Interfaces;


use Twig\Environment;

interface MemberResponderInterface
{
    public function __construct(Environment $twig);

    public function __invoke($redirect =false, array $collections);
}