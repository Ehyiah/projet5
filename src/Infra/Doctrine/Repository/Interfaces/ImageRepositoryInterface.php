<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 24/05/2018
 * Time: 18:16
 */

namespace App\Infra\Doctrine\Repository\Interfaces;


use App\Entity\Interfaces\ImageCollectionInterface;

interface ImageRepositoryInterface
{
    public function save(ImageCollectionInterface $imageCollection) : void;
}