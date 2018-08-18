<?php

namespace App\UI\Responder\Interfaces;


use Twig\Environment;

interface MemberResponderInterface
{
    /**
     * MemberResponderInterface constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig);

    /**
     * @param bool $redirect
     * @param array $collections
     *
     * @return mixed
     */
    public function __invoke($redirect =false, array $collections);
}
