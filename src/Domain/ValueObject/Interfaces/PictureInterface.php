<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 02/08/2018
 * Time: 11:27
 */

namespace App\Domain\ValueObject\Interfaces;


interface PictureInterface
{
    public function getFileName();

    public function getNewFileName();
}