<?php

namespace App\Entity;


use App\Domain\DTO\Security\Interfaces\AddUserDTOInterface;
use App\Entity\Interfaces\UserInterface as BaseUserInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Class User
 * @UniqueEntity(fields={"username"}, message="Nom d'utilisateur déjà utilisé")
 */
class User implements BaseUserInterface, UserInterface, \Serializable
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
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function __construct(AddUserDTOInterface $addUserDTO)
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

    /**
     * {@inheritdoc}
     */
    public function editPassword(string $password): string
    {
        return $this->password = $password;
    }

    /**
     * {@inheritdoc}
     */
    public function editEmail(string $email): string
    {
        return $this->email = $email;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
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
     * {@inheritdoc}
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * {@inheritdoc}
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getTokenValidity(): \DateTime
    {
        return $this->token_validity;
    }

    /**
     * {@inheritdoc}
     */
    public function getTokenReset(): string
    {
        return $this->token_reset;
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail(): string
    {
        return $this->email;
    }


    /**
     * {@inheritdoc}
     */
    public function addRoleAdmin(): bool
    {
        if (\in_array('ROLE_ADMIN', $this->roles)) {
            try {
                throw new \LogicException(sprintf(''));
            } catch (\LogicException $exception) {
                return false;
            }
        }

        $this->roles[] = 'ROLE_ADMIN';

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getUser(): User
    {
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreationDate(): \DateTime
    {
        return $this->creation_date;
    }
}
