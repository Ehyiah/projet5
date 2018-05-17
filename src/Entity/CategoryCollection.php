<?php

namespace App\Entity;

use App\Domain\DTO\AddCategoryDTO;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Class CategoryCollection
 * @package App\Entity
 */
class CategoryCollection
{
    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var string
     */
    private $category_collection;


    /**
     * relation avec Collection
     * @var |ArrayAccess
     */
    private $collections;



    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCategoryCollection(): string
    {
        return $this->category_collection;
    }

    /**
     * @return mixed
     */
    public function getCollections()
    {
        return $this->collections;
    }


    /**
     * CategoryCollection constructor.
     * @param AddCategoryDTO $addCategoryDTO
     */
    public function __construct(AddCategoryDTO $addCategoryDTO)
    {
        $this->id = Uuid::uuid4();
        $this->category_collection = $addCategoryDTO->category_collection;

        $this->collections = new ArrayCollection();
    }

    /**
     * @param $category
     */
    public function edit(string $category)
    {
        $this->category_collection = $category;
    }

}