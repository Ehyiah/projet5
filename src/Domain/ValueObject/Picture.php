<?php

namespace App\Domain\ValueObject;


use App\Domain\ValueObject\Interfaces\PictureInterface;

final class Picture implements PictureInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $extension;

    /**
     * @var string
     */
    private $newFileName;

    /**
     * Picture constructor.
     *
     * @param string $name
     * @param string $extension
     */
    public function __construct(string $name, string $extension)
    {
        $this->name = $name;
        $this->extension = $extension;
    }

    public function getFileName()
    {
        $this->newFileName = md5(str_rot13($this->name)).".".$this->extension;

        return $this->newFileName;
    }

    /**
     * @return string
     */
    public function getNewFileName(): string
    {
        return $this->newFileName;
    }


}