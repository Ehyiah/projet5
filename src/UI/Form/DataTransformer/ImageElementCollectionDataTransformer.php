<?php

namespace App\UI\Form\DataTransformer;


use App\Domain\DTO\AddElementImageDTO;
use App\Domain\ValueObject\Picture;
use App\Entity\ImageCollection;
use App\Service\FileUploader;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class ImageElementCollectionDataTransformer implements DataTransformerInterface
{
    /**
     * @var FileUploader
     */
    private $fileUploader;

    /**
     * ImageElementCollectionDataTransformer constructor.
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


        $picture = new Picture($value->getClientOriginalName(), $value->guessExtension());

        $this->fileUploader->upload($value, $picture->getFileName());

        return new ImageCollection($picture);
    }












    public function reverseTransformOLD($value)
    {
        dump($value);


        if ($value == null) {
            return null;
        }

        foreach ($value as $image) {
            $image->title = $this->fileUploader->upload($image->image);
            $value[] = new ImageCollection($image);
            unset($value[array_search($image, $value)]);
        }

        return $value;
    }
}