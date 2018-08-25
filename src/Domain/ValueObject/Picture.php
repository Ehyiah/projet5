<?php

namespace App\Domain\ValueObject;


use App\Domain\ValueObject\Interfaces\PictureInterface;

/**
 * Class Picture
 */
final class Picture implements PictureInterface
{
    /**
     * @var string|null
     */
    private $name = null;

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
     * {@inheritdoc}
     */
    public function __construct(string $name, string $extension)
    {
        $this->name = $name;
        $this->extension = $extension;
    }

    /**
     * {@inheritdoc}
     */
    public function getFileName()
    {
        $this->newFileName = md5(uniqid(str_rot13($this->name))).".".$this->extension;

        return $this->newFileName;
    }

    /**
     * {@inheritdoc}
     */
    public function getNewFileName(): ?string
    {
        return $this->newFileName;
    }
}
