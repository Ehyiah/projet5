<?php

namespace App\Entity\Interfaces;


use App\Entity\ElementCollection;
use App\Entity\ImageCollection;
use Ramsey\Uuid\UuidInterface;

interface ImageCollectionInterface
{
    /**
     * @param ElementCollection $image_element_collection
     */
    public function setImageElementCollection(ElementCollection $image_element_collection): void;

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface;

    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @return \DateTime
     */
    public function getCreationDate(): \DateTime;

    /**
     * @return \DateTime
     */
    public function getUpdateDate(): \DateTime;

    /**
     * @return ElementCollection
     */
    public function getImageElementCollection(): ElementCollection;

    /**
     * @param string $title
     */
    public function setTitle(string $title): void;

    /**
     * @return $this
     */
    public function getImage();

    /**
     * @param ImageCollection|null $image_element_collection
     */
    public function setImage(ImageCollection $image_element_collection = null): void;

    /**
     * @param string $title
     * @param \DateTime $update_date
     * @param \SplFileInfo $image
     *
     * @return mixed
     */
    public function edit(
        string $title,
        \DateTime $update_date,
        \SplFileInfo $image
    );
}
