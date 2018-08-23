<?php

namespace App\Domain\DTO\Collection;


use App\Domain\DTO\Collection\Interfaces\EditCollectionDTOInterface;
use App\Entity\CategoryCollection;
use App\Entity\ImageCollection;
use App\Entity\Interfaces\CategoryCollectionInterface;
use App\Entity\Interfaces\ImageCollectionInterface;

/**
 * Class EditCollectionDTO
 */
class EditCollectionDTO implements EditCollectionDTOInterface
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
     * {@inheritdoc}
     */
    public function __construct(
        string $name,
        string $tag = null,
        CategoryCollectionInterface $category,
        bool $visibility,
        ImageCollectionInterface $image = null
    ) {
        $this->name = $name;
        $this->tag = $tag;
        $this->category = $category;
        $this->visibility = $visibility;
        $this->image = $image;
    }
}
