<?php


namespace App\UI\Form\DataTransformer;

use App\Entity\ImageCollection;
use App\Service\FileUploader;
use App\Service\Interfaces\FileUploaderInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class ImagesElementCollectionDataTransformerFromCollection implements DataTransformerInterface
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
     *
     * @return array|mixed|null
     *
     * @throws \Exception
     */
    public function reverseTransform($value)
    {
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
