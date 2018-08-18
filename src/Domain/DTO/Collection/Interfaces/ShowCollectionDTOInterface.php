<?php

namespace App\Domain\DTO\Collection\Interfaces;


use App\Entity\Interfaces\CategoryCollectionInterface;

interface ShowCollectionDTOInterface
{
    /**
     * ShowCollectionDTOInterface constructor.
     *
     * @param CategoryCollectionInterface $categoryCollection
     */
    public function __construct(CategoryCollectionInterface $categoryCollection);

    /**
     * @return string
     */
    public function __toString() :string;
}
