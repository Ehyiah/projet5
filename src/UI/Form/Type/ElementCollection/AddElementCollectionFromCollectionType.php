<?php

namespace App\UI\Form\Type\ElementCollection;


use App\Domain\DTO\ElementCollection\AddElementCollectionDTO;
use App\Entity\Collection;
use App\UI\Form\Type\Image\ImageCollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Count;

/**
 * Class AddElementCollectionFromCollectionType
 */
class AddElementCollectionFromCollectionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array(
                'label' => 'Nom de l\'élément'
            ))
            ->add('region', TextType::class, array(
                'label' => 'Région',
                'required' => false
            ))
            ->add('author', TextType::class, array(
                'label' => 'Auteur',
                'required' => false
            ))
            ->add('publisher', TextType::class, array(
                'label' => 'Editeur',
                'required' => false
            ))
            ->add('etat', TextType::class, array(
                'label' => 'Etat de l\'élément',
                'required' => false
            ))
            ->add('buy_price', NumberType::class, array(
                'label' => 'Prix d\'achat',
                'required' => false
            ))
            ->add('support', TextType::class, array(
                'required' => false
            ))
            ->add('player_number', IntegerType::class, array(
                'label' => 'Nombre de joueurs',
                'required' => false
            ))
            ->add('value', NumberType::class, array(
                'label' => 'Valeur',
                'required' => false
            ))
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

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AddElementCollectionDTO::class,
            'empty_data' => function(FormInterface $form) {
                return new AddElementCollectionDTO(
                    $form->get('title')->getData(),
                    $form->get('region')->getData(),
                    $form->get('author')->getData(),
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
