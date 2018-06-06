<?php

namespace App\Form;

use App\Domain\DTO\AddElementCollectionDTO;
use App\Entity\Collection;
use App\Entity\ElementCollection;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ElementCollectionType extends AbstractType
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
            ->add('save', SubmitType::class)
        ;
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
                    $form->get('collection')->getData()
                );
            }
        ]);
    }
}
