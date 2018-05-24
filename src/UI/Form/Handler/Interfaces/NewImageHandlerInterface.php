<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 24/05/2018
 * Time: 18:11
 */

namespace App\UI\Form\Handler\Interfaces;


use Symfony\Component\Form\FormInterface;

interface NewImageHandlerInterface
{
    /**
     * @param FormInterface $form
     *
     * @return bool
     */
    public function handle(FormInterface $form): bool;
}
