<?php

namespace App\UI\Form\Type\ElementCollection;


use App\Domain\DTO\AddElementCollectionDTO;
use App\Entity\Collection;
use App\Entity\ElementCollection;
use App\UI\Form\DataTransformer\ImageElementCollectionDataTransformer;
use App\UI\Form\Type\Image\ImageCollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Count;

class NewElementCollectionType extends AbstractType
{
    /**
     * @var ImageElementCollectionDataTransformer
     */
    private $imageElementTransformer;

    /**
     * NewElementCollectionType constructor.
     *
     * @param ImageElementCollectionDataTransformer $imageElementTransformer
     */
    public function __construct(ImageElementCollectionDataTransformer $imageElementTransformer)
    {
        $this->imageElementTransformer = $imageElementTransformer;
    }


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
            #->add('id')
            #->add('collection_name')
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
                'prototype' => true,
                'allow_delete' => true,
                'entry_options' => array('label' => false),
                'by_reference' => false,
                'mapped' => false,
                'required' => false
            ))
        ;
        $builder->get('images')->addModelTransformer($this->imageElementTransformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ElementCollection::class,
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
