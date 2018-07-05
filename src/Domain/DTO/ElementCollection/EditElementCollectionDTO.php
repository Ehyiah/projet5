<?php

namespace App\Domain\DTO\ElementCollection;


use App\Entity\Collection;

class EditElementCollectionDTO
{
    /**
     * @var string
     */
    public $id;

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
     * @param string $title
     * @param string|null $region
     * @param string|null $publisher
     * @param string|null $etat
     * @param int|null $buy_price
     * @param string|null $support
     * @param int|null $player_number
     * @param float|null $value
     * @param Collection|null $collection
     * @param array|null $images
     */
    public function __construct(
        string $title,
        string $region = null,
        string $publisher = null,
        string $etat = null,
        int $buy_price = null,
        string $support = null,
        int $player_number = null,
        float $value = null,
        Collection $collection = null,
        array $images = null
    ) {
        $this->title = $title;
        $this->region = $region;
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