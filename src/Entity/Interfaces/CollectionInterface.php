<?php

namespace App\Entity\Interfaces;


use App\Domain\DTO\Collection\Interfaces\EditCollectionDTOInterface;

interface CollectionInterface
{
    public function edit(EditCollectionDTOInterface $editCollectionDTO);
}