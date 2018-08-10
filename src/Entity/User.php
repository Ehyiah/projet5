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
class User implements UserInterface, \Serializable
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
     * @var string
     */
    private $apiKey;

    /**
     * @var \DateTime
     */
    private $token_validity;

    /**
     * @var string
     */
    private $token_reset;

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

    public function editPassword($password)
    {
        $this->password = $password;
    }

    public function newResetToken($token)
    {
        $this->token_reset = $token;
        $date = new \DateTime('now');
        $date->add(new \DateInterval('PT1H'));
        $this->token_validity = $date;
    }


    /**
     * @return array
     */
    public function getRoles0()
    {
        return array('ROLE_USER');
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return null|string|void
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }


    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }



    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
        ));
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            ) = unserialize($serialized, ['allowed_classes' => true]);
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getTokenValidity(): \DateTime
    {
        return $this->token_validity;
    }

    /**
     * @return string
     */
    public function getTokenReset(): string
    {
        return $this->token_reset;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }


    public function addRoleAdmin()
    {
        if (in_array('ROLE_ADMIN', $this->roles)) {
            return true;
        }

        return $this->roles[] = 'ROLE_ADMIN';
    }
}