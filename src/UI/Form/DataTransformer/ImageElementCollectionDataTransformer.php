<?php

namespace App\UI\Form\DataTransformer;


use App\Domain\ValueObject\Picture;
use App\Entity\ImageCollection;
use App\Service\Interfaces\FileUploaderInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ImageElementCollectionDataTransformer implements DataTransformerInterface
{
    /**
     * @var FileUploaderInterface
     */
    private $fileUploader;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * ImageElementCollectionDataTransformer constructor.
     *
     * @param FileUploaderInterface $fileUploader
     */
    public function __construct(FileUploaderInterface $fileUploader, SessionInterface $session)
    {
        $this->fileUploader = $fileUploader;
        $this->session = $session;
    }


    public function transform($value)
    {
        // TODO: Implement transform() method.
    }

    /**
     * @param mixed $value
     *
     * @return ImageCollection|mixed|null
     *
     * @throws \Exception
     */
    public function reverseTransform($value)
    {
        if (\is_null($value)) {
            return null;
        }

        if (filesize($value) == null){
            $this->session->getFlashBag()->add('notice', 'Les images ne doivent pas faire plus de 1mo');
            return null;
        }
        if (filesize($value) > 1048576){
            $this->session->getFlashBag()->add('notice', 'Les images ne doivent pas faire plus de 1mo');
            return null;
        }

        $picture = new Picture($value->getClientOriginalName(), $value->guessExtension());

        $this->fileUploader->upload($value, $picture->getFileName());

        return new ImageCollection($picture);
    }
}
