<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur", uniqueConstraints={@ORM\UniqueConstraint(name="Mail_UNIQUE", columns={"Mail"}), @ORM\UniqueConstraint(name="Nom_UNIQUE", columns={"Nom"})})
 * @ORM\Entity
 */
class Utilisateur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=45, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="Password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="Mail", type="string", length=255, nullable=false)
     */
    private $mail;

    /**
     * @var int
     *
     * @ORM\Column(name="Groupe", type="integer", nullable=false)
     */
    private $groupe = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateCreation", type="datetime", nullable=false)
     */
    private $datecreation;






    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getMail(): string
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail(string $mail): void
    {
        $this->mail = $mail;
    }

    /**
     * @return int
     */
    public function getGroupe(): int
    {
        return $this->groupe;
    }

    /**
     * @param int $groupe
     */
    public function setGroupe(int $groupe): void
    {
        $this->groupe = $groupe;
    }

    /**
     * @return \DateTime
     */
    public function getDatecreation(): \DateTime
    {
        return $this->datecreation;
    }

    /**
     * @param \DateTime $datecreation
     */
    public function setDatecreation(\DateTime $datecreation): void
    {
        $this->datecreation = $datecreation;
    }




}
