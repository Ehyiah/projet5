<?php

namespace App\Domain\DTO\ElementCollection;


use App\Domain\DTO\ElementCollection\Interfaces\AddElementCollectionDTOInterface;
use App\Entity\Collection;
use App\Entity\Interfaces\CollectionInterface;

/**
 * Class AddElementCollectionDTO
 */
class AddElementCollectionDTO implements AddElementCollectionDTOInterface
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $region;

    /**
     * @var string
     */
    public $author;

    /**
     * @var string
     */
    public $publisher;

    /**
     * @var string
     */
    public $etat;

    /**
     * @var int
     */
    public $buy_price;

    /**
     * @var string
     */
    public $support;

    /**
     * @var int
     */
    public $player_number;

    /**
     * @var float
     */
    public $value;

    /**
     * @var Collection
     */
    public $collection;

    /**
     * @var array
     */
    public $images;

    /**
     * AddElementCollectionDTO constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        string $title = null,
        string $region = null,
        string $author = null,
        string $publisher = null,
        string $etat = null,
        int $buy_price = null,
        string $support = null,
        int $player_number = null,
        float $value = null,
        CollectionInterface $collection = null,
        array $images = null
    ) {
        $this->title = $title;
        $this->region = $region;
        $this->author = $author;
        $this->publisher = $publisher;
        $this->etat = $etat;
        $this->buy_price = $buy_price;
        $this->support = $support;
        $this->player_number = $player_number;
        $this->value = $value;
        $this->collection = $collection;
        $this->images = $images;
    }
}
