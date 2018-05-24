<?php


namespace App\Domain\DTO;


class AddElementImageDTO
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $image;

    /**
     * AddElementImageDTO constructor.
     *
     * @param string $title
     * @param string $image
     */
    public function __construct(
        string $title,
        string $image
    ) {
        $this->title = $title;
        $this->image = $image;
    }
}