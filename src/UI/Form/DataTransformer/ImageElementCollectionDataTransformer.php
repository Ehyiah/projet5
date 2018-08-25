<?php

namespace App\UI\Form\DataTransformer;


use App\Domain\ValueObject\Picture;
use App\Entity\ImageCollection;
use App\Service\Interfaces\FileUploaderInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class ImageElementCollectionDataTransformer implements DataTransformerInterface
{
    /**
     * @var FileUploaderInterface
     */
    private $fileUploader;

    /**
     * ImageElementCollectionDataTransformer constructor.
     *
     * @param FileUploaderInterface $fileUploader
     */
    public function __construct(FileUploaderInterface $fileUploader)
    {
        $this->fileUploader = $fileUploader;
    }


    public function transform($value)
    {
        // TODO: Implement transform() method.
    }

    /**
     * @param mixed $value
     * @return ImageCollection|mixed|null
     * @throws \Exception
     */
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