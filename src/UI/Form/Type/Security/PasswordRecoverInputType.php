<?php

namespace App\UI\Form\Type\Security;


use App\Domain\DTO\Security\PasswordRecoverInputDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PasswordRecoverInputType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PasswordRecoverInputDTO::class,
            'empty_data' => function(FormInterface $form) {
                return new PasswordRecoverInputDTO(
                    $form->get('name')->getData()
                );
            }
        ]);
    }
}