<?php


namespace App\Domain\DTO;


use App\Entity\Collection;
use App\Entity\ImageCollection;


class AddElementCollectionDTO
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
     * @param string $region
     * @param string $publisher
     * @param string $etat
     * @param int $buy_price
     * @param string $support
     * @param int $player_number
     * @param float $value
     * @param Collection $collection
     * @param array $images
     */
    public function __construct(string $title, string $region, string $publisher, string $etat, int $buy_price, string $support, int $player_number, float $value, Collection $collection, array $images)
    {
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