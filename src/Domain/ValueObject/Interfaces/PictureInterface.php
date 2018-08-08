<?php

namespace App\Domain\ValueObject\Interfaces;


interface PictureInterface
{
    public function getFileName();

    public function getNewFileName();
}