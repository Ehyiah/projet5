<?php


namespace App\Domain\DTO;


class AddElementImageDTO
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var \SplFileInfo
     */
    public $image;

    /**
     * AddElementImageDTO constructor.
     *
     * @param \SplFileInfo $image
     */
    public function __construct(\SplFileInfo $image = null)
    {
        $this->image = $image;
    }
}