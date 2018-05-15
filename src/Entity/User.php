<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 15/05/2018
 * Time: 09:37
 */

namespace App\Entity;

use Ramsey\Uuid\UuidInterface;

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

}