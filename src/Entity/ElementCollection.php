<?php

namespace App\Entity;

use App\Domain\DTO\AddElementCollectionDTO;
use App\Entity\Interfaces\ElementCollectionInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class ElementCollection
 * @package App\Entity
 */
class ElementCollection implements ElementCollectionInterface
{
    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $region;

    /**
     * @var string
     */
    private $author;

    /**
     * @var string
     */
    private $publisher;

    /**
     * @var string
     */
    private $etat;

    /**
     * @var float
     */
    private $buy_price;

    /**
     * @var string
     */
    private $support;

    /**
     * @var integer
     */
    private $player_number;

    /**
     * @var float
     */
    private $value;


    /**
     * relation avec ImageCollection
     * @var |ArrayAccess
     */
    private $images;

    /**
     * relation avec Collection
     * @var Collection
     */
    private $collection_name;




    /**
     * ElementCollection constructor.
     *
     * @param AddElementCollectionDTO $addElementCollectionDTO
     */
    public function __construct(AddElementCollectionDTO $addElementCollectionDTO)
    {
        $this->id = Uuid::uuid4();
        $this->title = $addElementCollectionDTO->title;
        $this->region = $addElementCollectionDTO->region;
        #$this->author = $author;
        $this->publisher = $addElementCollectionDTO->publisher;
        $this->etat = $addElementCollectionDTO->etat;
        $this->buy_price = $addElementCollectionDTO->buy_price;
        $this->support = $addElementCollectionDTO->support;
        $this->player_number = $addElementCollectionDTO->player_number;
        $this->value = $addElementCollectionDTO->value;
        #$this->collection_name = $collection_name;
    }

    /**
     * @param string $title
     * @param string $region
     * @param string $author
     * @param string $publisher
     * @param string $etat
     * @param float $buy_price
     * @param string $support
     * @param int $player_number
     * @param float $value
     */
    public function editAllElementCollection(
        string $title,
        string $region,
        string $author,
        string $publisher,
        string $etat,
        float $buy_price,
        string $support,
        int $player_number,
        float $value
    ){
        $this->title = $title;
        $this->region = $region;
        $this->author = $author;
        $this->publisher = $publisher;
        $this->etat = $etat;
        $this->buy_price = $buy_price;
        $this->support = $support;
        $this->player_number = $player_number;
        $this->value = $value;
    }

    /**
     * @param $itemToEdit
     * @param $content
     */
    public function editOneElementCollection($itemToEdit, $content){
        $this->$itemToEdit = $content;
    }
}