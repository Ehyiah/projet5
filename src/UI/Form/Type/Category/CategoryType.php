<?php

namespace App\UI\Form\Type\Category;

use App\Domain\DTO\AddCategoryDTO;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


/**
 * Class CategoryType
 * @package App\Form
 */
class CategoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category_collection', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Créer une nouvelle catégorie'))
        ;
    }


    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AddCategoryDTO::class,
            'empty_data' => function (FormInterface $form){
                return new AddCategoryDTO(
                    $form->get('category_collection')->getData()
                );
            }
        ]);
    }
}
