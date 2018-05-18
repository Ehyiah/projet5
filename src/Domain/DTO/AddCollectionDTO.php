<?php

namespace App\Domain\DTO;

use App\Entity\CategoryCollection;

class AddCollectionDTO
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
     * AddCollectionDTO constructor.
     *
     * @param string $name
     * @param string $tag
     * @param CategoryCollection $category
     * @param bool $visibility
     */
    public function __construct(
        string $name,
        string $tag,
        CategoryCollection $category,
        bool $visibility
    ) {
        $this->name = $name;
        $this->tag = $tag;
        $this->category = $category;
        $this->visibility = $visibility;
    }
}