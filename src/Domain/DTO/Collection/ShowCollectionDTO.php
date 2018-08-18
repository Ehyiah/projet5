<?php

namespace App\Domain\DTO\Collection;


use App\Domain\DTO\Collection\Interfaces\ShowCollectionDTOInterface;
use App\Entity\CategoryCollection;
use App\Entity\Interfaces\CategoryCollectionInterface;

/**
 * Class ShowCollectionDTO
 */
class ShowCollectionDTO implements ShowCollectionDTOInterface
{
    /**
     * @var CategoryCollection
     */
    public $categoryCollection;

    /**
     * ShowCollectionDTO constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(CategoryCollectionInterface $categoryCollection)
    {
        $this->categoryCollection = $categoryCollection;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString() :string
    {
        return $this->categoryCollection;
    }
}