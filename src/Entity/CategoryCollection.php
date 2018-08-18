<?php

namespace App\Entity;


use App\Domain\DTO\Category\Interfaces\AddCategoryDTOInterface;
use App\Entity\Interfaces\CategoryCollectionInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class CategoryCollection
 */
class CategoryCollection implements CategoryCollectionInterface
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
     * CategoryCollection constructor.
     *
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function __construct(AddCategoryDTOInterface $addCategoryDTO)
    {
        $this->id = Uuid::uuid4();
        $this->category_collection = $addCategoryDTO->category_collection;

        $this->collections = new ArrayCollection();
    }
    

    /**
     * {@inheritdoc}
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getCategoryCollection(): string
    {
        return $this->category_collection;
    }

    /**
     * {@inheritdoc}
     */
    public function getCollections()
    {
        return $this->collections;
    }

    /**
     * {@inheritdoc}
     */
    public function edit(string $category)
    {
        return $this->category_collection = $category;
    }
}