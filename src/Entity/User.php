<?php

namespace App\Entity;


use App\Domain\DTO\AddUserDTO;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints\DateTime;


/**
 * Class User
 * @package App\Entity
 */
class User implements UserInterface
{
    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $email;

    /**
     * @var integer
     */
    private $groupe;

    /**
     * @var datetime
     */
    private $creation_date;

    /**
     * @var datetime
     */
    private $validation_date;

    /**
     * @var array
     */
    private $roles;


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
     * @param AddUserDTO $addUserDTO
     */
    public function __construct(AddUserDTO $addUserDTO)
    {
        $this->id = Uuid::uuid4();
        $this->username = $addUserDTO->username;
        $this->password = $addUserDTO->password;
        $this->email = $addUserDTO->email;
        $this->creation_date = new \DateTime('now');
        $this->roles[] = 'ROLE_USER';
    }

    /**
     * Validation User
     */
    public function validate()
    {
        $this->validation_date = new DateTime('now');
    }

    /**
     * @param string $username
     * @param string $email
     */
    public function edit(
        string $username,
        string $email
    ){
        $this->username = $username;
        $this->email = $email;
    }




    public function getRoles()
    {
        // TODO: Implement getRoles() method.
    }

    public function getPassword()
    {
        // TODO: Implement getPassword() method.
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }


}