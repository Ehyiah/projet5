<?php

namespace App\UI\Form\Extension\Interfaces;


use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

interface ImageTypeExtensionInterface
{
    /**
     * ImageTypeExtensionInterface constructor.
     *
     * @param string $publicImageFolder
     */
    public function __construct(string $publicImageFolder);

    /**
     * @return mixed
     */
    public function getExtendedType();

    /**
     * @param OptionsResolver $resolver
     *
     * @return mixed
     */
    public function configureOptions(OptionsResolver $resolver);

    /**
     * @param FormView $view
     * @param FormInterface $form
     * @param array $options
     *
     * @return mixed
     */
    public function buildView(FormView $view, FormInterface $form, array $options);
}
