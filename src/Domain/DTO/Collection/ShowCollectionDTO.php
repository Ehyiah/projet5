<?php

namespace App\Domain\DTO\Collection;


use App\Entity\CategoryCollection;

class ShowCollectionDTO
{
    /**
     * @var CategoryCollection
     */
    public $categoryCollection;

    /**
     * ShowCollectionDTO constructor.
     *
     * @param CategoryCollection $categoryCollection
     */
    public function __construct(CategoryCollection $categoryCollection)
    {
        $this->categoryCollection = $categoryCollection;
    }

    /**
     * @return string
     */
    public function __toString() :string
    {
        return $this->categoryCollection;
    }
}