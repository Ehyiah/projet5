<?php

namespace App\Domain\DTO;


class AddCommentDTO
{

    /**
     * @var string
     */
    public $comment_content;

    /**
     * AddCommentDTO constructor.
     *
     * @param string $comment_content
     */
    public function __construct(string $comment_content)
    {
        $this->comment_content = $comment_content;
    }
}