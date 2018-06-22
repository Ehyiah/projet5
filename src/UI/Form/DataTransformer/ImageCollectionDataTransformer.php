<?php

namespace App\UI\Form\DataTransformer;


use App\Domain\DTO\AddElementImageDTO;
use App\Entity\ImageCollection;
use App\Service\FileUploader;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;


class ImageCollectionDataTransformer implements DataTransformerInterface
{
    /**
     * @var FileUploader
     */
    private $fileUploader;

    /**
     * ImageCollectionDataTransformer constructor.
     *
     * @param FileUploader $fileUploader
     */
    public function __construct(FileUploader $fileUploader)
    {
        $this->fileUploader = $fileUploader;
    }


    public function transform($value)
    {
      // TODO: Implement transform() method.
    }

    public function reverseTransform($value)
    {
        if ($value == null) {
            return null;
        }

        $image = new AddElementImageDTO($value);
        $image->title = $this->fileUploader->upload($image->image);
        return new ImageCollection($image);
    }
}