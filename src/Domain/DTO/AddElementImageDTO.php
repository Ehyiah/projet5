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
     * @param string $title
     * @param \SplFileInfo $image
     */
    public function __construct(
        string $title,
        \SplFileInfo $image
    ) {
        $this->title = $title;
        $this->image = $image;
    }
}