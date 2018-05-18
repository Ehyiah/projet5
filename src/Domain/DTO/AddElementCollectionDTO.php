<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 18/05/2018
 * Time: 09:56
 */

namespace App\Domain\DTO;


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
     * AddElementCollectionDTO constructor.
     *
     * @param $title
     * @param $region
     * @param $publisher
     * @param $etat
     * @param $buy_price
     * @param $support
     * @param $player_number
     * @param $value
     */
    public function __construct(
        $title,
        $region,
        $publisher,
        $etat,
        $buy_price,
        $support,
        $player_number,
        $value
    ) {
        $this->title = $title;
        $this->region = $region;
        $this->publisher = $publisher;
        $this->etat = $etat;
        $this->buy_price = $buy_price;
        $this->support = $support;
        $this->player_number = $player_number;
        $this->value = $value;
    }


}