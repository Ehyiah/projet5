<?php

namespace App\UI\Form\Type\Collection;


use App\Domain\DTO\AddCollectionDTO;
use App\Entity\CategoryCollection;
use App\UI\Form\DataTransformer\ImageCollectionDataTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateCollectionType extends AbstractType
{
    /**
     * @var ImageCollectionDataTransformer
     */
    private $imageCollectionDataTransformer;

    /**
     * CreateCollectionType constructor.
     *
     * @param ImageCollectionDataTransformer $imageCollectionDataTransformer
     */
    public function __construct(ImageCollectionDataTransformer $imageCollectionDataTransformer)
    {
        $this->imageCollectionDataTransformer = $imageCollectionDataTransformer;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('tag', TextType::class)
            #->add('owner')
            ->add('category', EntityType::class, array(
                'class'=>CategoryCollection::class,
                'label'=>'Catégorie de la collection',
                'choice_label'=>'category_collection'))
            ->add('visibility', ChoiceType::class, array(
                'choices'  => array(
                    'Oui' => 1,
                    'Non' => 0,
                    ),
                'label' => 'Masquer la collection aux autres utilisateurs'
            ))
            ->add('image', FileType::class, array(
                'required' => false
            ))
        ;
        $builder->get('image')->addModelTransformer($this->imageCollectionDataTransformer);
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
                    $form->get('visibility')->getData(),
                    $form->get('image')->getData()
                );
            }
        ]);
    }
}