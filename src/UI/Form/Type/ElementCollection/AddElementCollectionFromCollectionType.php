<?php

namespace App\UI\Form\Type\ElementCollection;


use App\Domain\DTO\ElementCollection\AddElementCollectionDTO;
use App\Entity\Collection;
use App\UI\Form\Type\Image\ImageCollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Count;

class AddElementCollectionFromCollectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('region')
            #->add('author')
            ->add('publisher')
            ->add('etat')
            ->add('buy_price')
            ->add('support')
            ->add('player_number')
            ->add('value')
            ->add('collection', EntityType::class, array(
                'class'=>Collection::class,
                'label'=>'Collection',
                'choice_label'=>function($collection)
                {
                    return $collection->getCollectionName();
                }
            ))
            ->add('images', CollectionType::class, array(
                'entry_type' => ImageCollectionType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'entry_options' => array('label' => false),
                'required' => false
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AddElementCollectionDTO::class,
            'empty_data' => function(FormInterface $form) {
                return new AddElementCollectionDTO(
                    $form->get('title')->getData(),
                    $form->get('region')->getData(),
                    $form->get('publisher')->getData(),
                    $form->get('etat')->getData(),
                    $form->get('buy_price')->getData(),
                    $form->get('support')->getData(),
                    $form->get('player_number')->getData(),
                    $form->get('value')->getData(),
                    $form->get('collection')->getData(),
                    $form->get('images')->getData()
                );
            }
        ]);
    }
}