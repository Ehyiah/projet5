<?php

namespace App\UI\Form\Type\Security;


use App\Domain\DTO\Security\ChangePasswordDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

/**
 * Class ChangePasswordType
 */
class ChangePasswordType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('oldPassword', PasswordType::class, array(
                'label' => 'Mot de passe actuel'
            ))
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Nouveau Mot de Passe'),
                'second_options' => array('label' => 'Confirmation du Nouveau Mot de Passe'),
                'constraints' => array(new Length(array('min' => 6)))
            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class' => ChangePasswordDTO::class,
           'empty_data' => function(FormInterface $form) {
                return new ChangePasswordDTO(
                    $form->get('password')->getData(),
                    $form->get('oldPassword')->getData()
                );
           }
        ]);
    }
}
