<?php

namespace App\Domain\DTO\Collection\Interfaces;


use App\Entity\Interfaces\CategoryCollectionInterface;
use App\Entity\Interfaces\ImageCollectionInterface;

interface AddCollectionDTOInterface
{
    /**
     * AddCollectionDTOInterface constructor.
     *
     * @param string $name
     * @param string|null $tag
     * @param CategoryCollectionInterface $category
     * @param bool $visibility
     * @param ImageCollectionInterface|null $image
     */
    public function __construct(
        string $name,
        string $tag = null,
        CategoryCollectionInterface $category,
        bool $visibility,
        ImageCollectionInterface $image = null
    );
}