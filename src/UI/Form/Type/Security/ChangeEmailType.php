<?php

namespace App\UI\Form\Type\Security;


use App\Domain\DTO\Security\ChangeEmailDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ChangeEmailType
 */
class ChangeEmailType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'label' => 'E-mail'
            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ChangeEmailDTO::class,
            'empty_data' => function(FormInterface $form) {
                return new ChangeEmailDTO(
                    $form->get('email')->getData()
                );
            }
        ]);
    }
}
