<?php

namespace App\Domain\ValueObject\Interfaces;


interface PictureInterface
{
    public function __construct(string $name, string $extension);

    public function getFileName();

    public function getNewFileName();
}