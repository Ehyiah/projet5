<?php

namespace App\Domain\ValueObject\Interfaces;


interface PictureInterface
{
    /**
     * PictureInterface constructor.
     *
     * @param string $name
     * @param string $extension
     */
    public function __construct(string $name, string $extension);

    /**
     * @return mixed
     */
    public function getFileName();

    /**
     * @return null|string
     */
    public function getNewFileName(): ?string;
}
