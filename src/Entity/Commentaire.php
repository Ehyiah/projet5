<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire", indexes={@ORM\Index(name="fk_Commentaire_Utilisateur1_idx", columns={"id_User"}), @ORM\Index(name="fk_Commentaire_Collection1_idx", columns={"id_Collection"})})
 * @ORM\Entity
 */
class Commentaire
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
     * @var \Collection
     *
     * @ORM\ManyToOne(targetEntity="Collection")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Collection", referencedColumnName="id")
     * })
     */
    private $idCollection;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_User", referencedColumnName="id")
     * })
     */
    private $idUser;






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
     * @return \Collection
     */
    public function getIdCollection(): \Collection
    {
        return $this->idCollection;
    }

    /**
     * @param \Collection $idCollection
     */
    public function setIdCollection(\Collection $idCollection): void
    {
        $this->idCollection = $idCollection;
    }

    /**
     * @return \Utilisateur
     */
    public function getIdUser(): \Utilisateur
    {
        return $this->idUser;
    }

    /**
     * @param \Utilisateur $idUser
     */
    public function setIdUser(\Utilisateur $idUser): void
    {
        $this->idUser = $idUser;
    }



}
