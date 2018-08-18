<?php

namespace App\Domain\DTO\Category;


use App\Domain\DTO\Category\Interfaces\AddCategoryDTOInterface;

/**
 * Class AddCategoryDTO
 */
class AddCategoryDTO implements AddCategoryDTOInterface
{
    /**
     * @var string
     */
    public $category_collection;

    /**
     * AddCategoryDTO constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(string $category_collection)
    {
        $this->category_collection = $category_collection;
    }
}
