<?php

namespace App\UI\Responder\Interfaces;


interface MemberResponderInterface
{
    public function __invoke($redirect =false, array $collections);
}