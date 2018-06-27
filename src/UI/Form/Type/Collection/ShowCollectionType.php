<?php

namespace App\UI\Form\Type\Collection;


use App\Domain\DTO\Collection\ShowCollectionDTO;
use App\Entity\CategoryCollection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShowCollectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categoryCollection', EntityType::class, array(
                'class' => CategoryCollection::class,
                'label' => 'Choisissez le type de Collection',
                'choice_label' => 'category_collection'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ShowCollectionDTO::class,
            'empty_data' => function(FormInterface $form) {
                return new ShowCollectionDTO(
                    $form->get('categoryCollection')->getData()
                );
            }
        ]);
    }
}