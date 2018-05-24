<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 15/05/2018
 * Time: 09:37
 */

namespace App\Entity;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Validator\Constraints\Date;

/**
 * Class User
 * @package App\Entity
 */
class User
{
    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $mail;

    /**
     * @var integer
     */
    private $groupe;

    /**
     * @var date
     */
    private $creation_date;

    /**
     * @var date
     */
    private $validation_date;



    /**
     * relation avec Comment
     * @var |ArrayAccess
     */
    private $comments;

    /**
     * relation avec Collection
     * @var |ArrayAccess
     */
    private $collections;


    /**
     * User constructor.
     *
     * @param string $name
     * @param string $password
     * @param string $mail
     * @param int $groupe
     * @param Date $creation_date
     */
    public function __construct(
        string $name,
        string $password,
        string $mail,
        int $groupe,
        date $creation_date
    ) {
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->password = $password;
        $this->mail = $mail;
        $this->groupe = $groupe;
        $this->creation_date = new Date('now');
    }

    /**
     * Validation User
     */
    public function validate()
    {
        $this->validation_date = new Date('now');
    }

    /**
     * @param string $name
     * @param string $mail
     */
    public function edit(
        string $name,
        string $mail
    ){
        $this->name = $name;
        $this->mail = $mail;
    }
}