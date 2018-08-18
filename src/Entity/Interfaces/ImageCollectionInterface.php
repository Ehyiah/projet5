<?php

namespace App\Entity\Interfaces;


interface ImageCollectionInterface
{
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