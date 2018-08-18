<?php

namespace App\Domain\DTO\ElementCollection\Interfaces;


use App\Entity\Interfaces\CollectionInterface;

interface EditElementCollectionDTOInterface
{
    /**
     * EditElementCollectionDTOInterface constructor.
     *
     * @param string $title
     * @param string|null $region
     * @param string|null $publisher
     * @param string|null $etat
     * @param int|null $buy_price
     * @param string|null $support
     * @param int|null $player_number
     * @param float|null $value
     * @param CollectionInterface|null $collection
     * @param array $images
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
        CollectionInterface $collection = null,
        array $images = []
    );
}
