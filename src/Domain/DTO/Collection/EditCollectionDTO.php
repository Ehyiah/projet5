<?php

namespace App\Domain\DTO\Collection;


use App\Entity\CategoryCollection;
use App\Entity\ImageCollection;

class EditCollectionDTO
{

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $tag;

    /**
     * @var CategoryCollection
     */
    public $category;

    /**
     * @var bool
     */
    public $visibility;

    /**
     * @var ImageCollection
     */
    public $image;

    /**
     * EditCollectionDTO constructor.
     *
     * @param string $name
     * @param string $tag
     * @param CategoryCollection $category
     * @param bool $visibility
     * @param ImageCollection|null $image
     */
    public function __construct(
        string $name,
        string $tag,
        CategoryCollection $category,
        bool $visibility,
        ImageCollection $image = null
    ) {
        $this->name = $name;
        $this->tag = $tag;
        $this->category = $category;
        $this->visibility = $visibility;
        $this->image = $image;
    }
}