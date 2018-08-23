<?php

namespace App\UI\Form\Type\Image;


use App\Domain\DTO\AddElementImageDTO;
use App\UI\Form\DataTransformer\ImageElementCollectionDataTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ImageCollectionType
 */
class ImageCollectionType extends AbstractType
{
    /**
     * @var ImageElementCollectionDataTransformer
     */
    private $imageElementTransformer;

    /**
     * ImageCollectionType constructor.
     *
     * @param ImageElementCollectionDataTransformer $imageElementTransformer
     */
    public function __construct(ImageElementCollectionDataTransformer $imageElementTransformer)
    {
        $this->imageElementTransformer = $imageElementTransformer;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('image', FileType::class, array(
                'required' => false,
                'image_property' => 'image_url'
            ))
        ;
        $builder->get('image')->addModelTransformer($this->imageElementTransformer);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AddElementImageDTO::class,
            'empty_data' => function(FormInterface $form) {
                return new AddElementImageDTO(
                    $form->get('image')->getData()
                );
            },
        ]);
    }
}
