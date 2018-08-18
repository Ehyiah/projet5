<?php

namespace App\Domain\DTO\Collection;


use App\Domain\DTO\Collection\Interfaces\AddCollectionDTOInterface;
use App\Entity\ImageCollection;
use App\Entity\CategoryCollection;
use App\Entity\Interfaces\CategoryCollectionInterface;
use App\Entity\Interfaces\ImageCollectionInterface;

/**
 * Class AddCollectionDTO
 */
class AddCollectionDTO implements AddCollectionDTOInterface
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
     * AddCollectionDTO constructor.
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
