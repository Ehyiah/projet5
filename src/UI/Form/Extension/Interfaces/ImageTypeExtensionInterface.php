<?php

namespace App\UI\Form\Extension\Interfaces;


use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

interface ImageTypeExtensionInterface
{
    public function getExtendedType();

    public function configureOptions(OptionsResolver $resolver);

    public function buildView(FormView $view, FormInterface $form, array $options);
}