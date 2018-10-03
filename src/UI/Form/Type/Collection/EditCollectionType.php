<?php

namespace App\UI\Form\Type\Collection;


use App\Domain\DTO\Collection\EditCollectionDTO;
use App\Entity\CategoryCollection;
use App\Subscriber\Form\EditCollectionTypeSubscriber;
use App\UI\Form\DataTransformer\ImageCollectionDataTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditCollectionType extends AbstractType
{
    /**
     * @var ImageCollectionDataTransformer
     */
    private $imageCollectionDataTransformer;

    /**
     * @var EditCollectionTypeSubscriber
     */
    private $editCollectionTypeSubscriber;

    /**
     * EditCollectionType constructor.
     *
     * @param ImageCollectionDataTransformer $imageCollectionDataTransformer
     * @param EditCollectionTypeSubscriber $editCollectionTypeSubscriber
     */
    public function __construct(
        ImageCollectionDataTransformer $imageCollectionDataTransformer,
        EditCollectionTypeSubscriber $editCollectionTypeSubscriber
    ) {
        $this->imageCollectionDataTransformer = $imageCollectionDataTransformer;
        $this->editCollectionTypeSubscriber = $editCollectionTypeSubscriber;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => 'Nom de la Collection'
            ))
            ->add('tag', TextType::class, array(
                'required' => false
            ))
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
                'required' => false,
                'invalid_message' => 'Le fichier ne doit pas faire plus de 1mo',
            ))
            ->addEventSubscriber($this->editCollectionTypeSubscriber)
        ;
        $builder->get('image')->addModelTransformer($this->imageCollectionDataTransformer);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EditCollectionDTO::class,
            'empty_data' => function (FormInterface $form){
                return new EditCollectionDTO(
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
