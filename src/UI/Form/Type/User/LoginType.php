<?php

namespace App\UI\Form\Type\User;


use App\Domain\DTO\Security\LoginDTO;
use App\Domain\DTO\Security\Interfaces\LoginDTOInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class LoginType
 */
class LoginType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class)
            ->add('password', PasswordType::class);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LoginDTOInterface::class,
            'empty_data' => function(FormInterface $form) {
                return new LoginDTO(
                    $form->get('username')->getData(),
                    $form->get('password')->getData()
                );
            }
        ]);
    }
}
