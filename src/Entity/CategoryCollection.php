<?php

namespace App\Entity;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;


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
     * CategoryCollection constructor.
     * @param $content
     */
    public function __construct($content)
    {
        $this->id = Uuid::uuid4();
        $this->category_collection = $content;
    }


    /**
     * @param string $category_collection
     */
    public function setCategoryCollection(string $category_collection): void
    {
        $this->category_collection = $category_collection;
    }


}