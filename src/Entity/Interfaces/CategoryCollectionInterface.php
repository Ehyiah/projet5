<?php

namespace App\Entity\Interfaces;


use Ramsey\Uuid\UuidInterface;

interface CategoryCollectionInterface
{
    /**
     * @param string $category
     *
     * @return mixed
     */
    public function edit(string $category);

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface;

    /**
     * @return string
     */
    public function getCategoryCollection(): string;

    /**
     * @return mixed
     */
    public function getCollections();


}
