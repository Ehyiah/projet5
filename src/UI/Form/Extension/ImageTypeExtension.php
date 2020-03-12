<?php

namespace App\UI\Form\Extension;

use App\UI\Form\Extension\Interfaces\ImageTypeExtensionInterface;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * Class ImageTypeExtension
 */
class ImageTypeExtension extends AbstractTypeExtension implements ImageTypeExtensionInterface
{
    /**
     * @var string
     */
    private $publicImageFolder;

    /**
     * ImageTypeExtension constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(string $publicImageFolder)
    {
        $this->publicImageFolder = $publicImageFolder;
    }

    public static function getExtendedTypes(): iterable
    {
        return [FileType::class];
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return FileType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefined(array('image_property'));
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if (isset($options['image_property'])) {
            $parentData = $form->getParent()->getData();

            $imageUrl = null;
            if (!\is_null($parentData)) {
                $accessor = PropertyAccess::createPropertyAccessor();
                $imageUrl = $accessor->getValue($parentData, 'image');
            }

            $view->vars['image_url'] = sprintf('%s/%s', $this->publicImageFolder, !\is_null($imageUrl) ? $imageUrl->getTitle() : null);
        }
    }
}
