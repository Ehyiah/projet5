<?php

namespace App\Domain\DTO\Category\Interfaces;


interface AddCategoryDTOInterface
{
    /**
     * AddCategoryDTOInterface constructor.
     *
     * @param string $category_collection
     */
    public function __construct(string $category_collection);
}
