<?php

namespace App\UI\Form\Type\User;


use App\Domain\DTO\Security\ChangePasswordFromEmailDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangePasswordFromEmailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('password', PasswordType::class)
            ->add('token', HiddenType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class' => ChangePasswordFromEmailDTO::class,
           'empty_data' => function(FormInterface $form) {
                return new ChangePasswordFromEmailDTO(
                    $form->get('password')->getData(),
                    $form->get('token')->getData()
                );
           }
        ]);
    }
}