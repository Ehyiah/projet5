<?php

namespace App\Domain\DTO;


use App\Entity\ImageCollection;

class AddElementImageDTO
{
    /**
     * @var \SplFileInfo
     */
    public $image;

    /**
     * AddElementImageDTO constructor.
     *
     * @param ImageCollection $imageCollection
     */
    public function __construct(ImageCollection $imageCollection)
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