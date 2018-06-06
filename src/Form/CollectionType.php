<?php

namespace App\Form;

use App\Domain\DTO\AddCollectionDTO;
use App\Entity\CategoryCollection;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CollectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('tag', TextType::class)
            #->add('owner')
            ->add('category', EntityType::class, array(
                'class'=>CategoryCollection::class,
                'label'=>'Catégorie de la collection',
                'choice_label'=>function($category)
                    {
                        return $category->getCategoryCollection();
                    }))
            ->add('visibility', ChoiceType::class, array(
                'choices'  => array(
                    'Oui' => 1,
                    'Non' => 0,
                    ),
                'label' => 'Masquer la collection aux autres utilisateurs'
            ))
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AddCollectionDTO::class,
            'empty_data' => function (FormInterface $form){
                return new AddCollectionDTO(
                    $form->get('name')->getData(),
                    $form->get('tag')->getData(),
                    $form->get('category')->getData(),
                    $form->get('visibility')->getData()
                );
            }
        ]);
    }
}