<?php

namespace App\UI\Form\Type\Security;


use App\Domain\DTO\Security\PasswordRecoverInputDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PasswordRecoverInputType
 */
class PasswordRecoverInputType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => 'Nom d\'utilisateur utilisé lors de l\'enregistrement'
            ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
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
