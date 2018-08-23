<?php

namespace App\Domain\DTO;


use App\Entity\ImageCollection;
use App\Entity\Interfaces\ImageCollectionInterface;

class AddElementImageDTO
{
    /**
     * @var \SplFileInfo
     */
    public $image;

    /**
     * AddElementImageDTO constructor.
     *
     * @param ImageCollectionInterface $imageCollection
     */
    public function __construct(ImageCollectionInterface $imageCollection)
    {
        $this->image = $imageCollection;
    }

    /**
     * @return string
     */
    public function getImageUrl()
    {
        $title = $this->image->getTitle();

        return '/upload/CollectionImage/'.$title;
    }
}