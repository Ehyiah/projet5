<?php

namespace App\Entity\Interfaces;


use App\Domain\DTO\ElementCollection\EditElementCollectionDTO;
use App\Entity\Collection;
use App\Entity\ImageCollection;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\UuidInterface;

interface ElementCollectionInterface
{
    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface;

    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @return null|string
     */
    public function getRegion(): ?string;

    /**
     * @return null|string
     */
    public function getAuthor(): ?string;

    /**
     * @return null|string
     */
    public function getPublisher(): ?string;

    /**
     * @return null|string
     */
    public function getEtat(): ?string;

    /**
     * @return float|null
     */
    public function getBuyPrice(): ?float;

    /**
     * @return null|string
     */
    public function getSupport(): ?string;

    /**
     * @return int|null
     */
    public function getPlayerNumber(): ?int;

    /**
     * @return float|null
     */
    public function getValue(): ?float;

    /**
     * @return ImageCollection
     */
    public function getImages();

    /**
     * @param ArrayCollection $images
     */
    public function setImages(ArrayCollection $images): void;

    /**
     * @return Collection
     */
    public function getCollectionName(): Collection;

    /**
     * @param array|null $images
     */
    public function addImageToCollection(array $images = null);

    /**
     * @param EditElementCollectionDTO $elementCollectionDTO
     */
    public function editElement(EditElementCollectionDTO $elementCollectionDTO);

    /**
     * @param array|null $images
     */
    public function editImageToCollection(array $images = null);

    /**
     * @param ImageCollection $image
     */
    public function removeImageFromCollection(ImageCollection $image);
}
