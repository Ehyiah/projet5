<?php

namespace App\Domain\DTO;

class AddCategoryDTO
{
    /**
     * @var string
     */
    public $category_collection;


    /**
     * AddCategoryDTO constructor.
     *
     * @param string $category_collection
     */
    public function __construct(
        string $category_collection
    ) {
        $this->category_collection = $category_collection;
    }
}