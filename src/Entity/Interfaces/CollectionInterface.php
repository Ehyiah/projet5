<?php

namespace App\Entity\Interfaces;


use App\Domain\DTO\Collection\Interfaces\EditCollectionDTOInterface;
use App\Entity\CategoryCollection;
use App\Entity\ImageCollection;
use App\Entity\User;
use Ramsey\Uuid\UuidInterface;

interface CollectionInterface
{
    /**
     * @param EditCollectionDTOInterface $editCollectionDTO
     *
     * @return mixed
     */
    public function edit(EditCollectionDTOInterface $editCollectionDTO);

    /**
     * @param User $owner
     */
    public function setOwner(User $owner): void;

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface;

    /**
     * @return string
     */
    public function getCollectionName(): string;

    /**
     * @return \DateTime
     */
    public function getCreationDate(): \DateTime;

    /**
     * @return null|string
     */
    public function getTag(): ?string;

    /**
     * @return int
     */
    public function getHidden(): int;

    /**
     * @return \DateTime
     */
    public function getUpdateDate(): \DateTime;

    /**
     * @return mixed
     */
    public function getElementsCollection();

    /**
     * @return mixed
     */
    public function getCollectionComments();

    /**
     * @return CategoryCollection
     */
    public function getCategory(): CategoryCollection;

    /**
     * @return ImageCollection|null
     */
    public function getImage(): ?ImageCollection;

    /**
     * @return User
     */
    public function getOwner(): User;
}
