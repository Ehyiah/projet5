<?php

namespace App\UI\Form\Extension;


use App\UI\Form\Extension\Interfaces\ImageTypeExtensionInterface;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccess;

class ImageTypeExtension extends AbstractTypeExtension implements ImageTypeExtensionInterface
{
    public function getExtendedType()
    {
        return FileType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefined(array('image_property'));
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if (isset($options['image_property'])) {
            $parentData = $form->getParent()->getData();

            $imageUrl = null;
            if (null !== $parentData) {
                $accessor = PropertyAccess::createPropertyAccessor();
                $imageUrl = $accessor->getValue($parentData, $options['image_property']);
            }

            $view->vars['image_url'] = $imageUrl;
        }
    }
}