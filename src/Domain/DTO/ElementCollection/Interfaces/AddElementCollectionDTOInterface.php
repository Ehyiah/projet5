<?php

namespace App\Domain\DTO\ElementCollection\Interfaces;


use App\Entity\Interfaces\CollectionInterface;

interface AddElementCollectionDTOInterface
{
    /**
     * AddElementCollectionDTOInterface constructor.
     *
     * @param string|null $title
     * @param string|null $region
     * @param string|null $author
     * @param string|null $publisher
     * @param string|null $etat
     * @param int|null $buy_price
     * @param string|null $support
     * @param int|null $player_number
     * @param float|null $value
     * @param CollectionInterface|null $collection
     * @param array|null $images
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
    );
}
