<?php

namespace App\UI\Form\Handler\Security\Interfaces;


use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

interface ChangePasswordFromEmailHandlerInterface
{
    public function handle(FormInterface $form, Request $request);
}