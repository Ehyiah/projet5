<?php

namespace App\Form;

use App\Domain\DTO\AddElementImageDTO;
use App\Entity\ImageCollection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageCollectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('image', FileType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ImageCollection::class,
            'empty_data' => function(FormInterface $form) {
                return new AddElementImageDTO(
                    $form->get('image')->getData()
                );
            },
        ]);
    }
}