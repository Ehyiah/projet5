<?php

namespace App\UI\Form\Type\User;


use App\Domain\DTO\Security\ChangePasswordFromEmailDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

/**
 * Class ChangePasswordFromEmailType
 */
class ChangePasswordFromEmailType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('password', PasswordType::class, array(
                'label' => 'Nouveau Mot de passe',
                'constraints' => array(new Length(array('min' => 6)))
            ))
            ->add('token', HiddenType::class);
    }

    /**
     * @param OptionsResolver $resolver
     */
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
