<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Collection
 *
 * @ORM\Table(name="collection", indexes={@ORM\Index(name="fk_Collection_Categorie_idx", columns={"id_Categorie"}), @ORM\Index(name="fk_Collection_Utilisateur1_idx", columns={"id_User"}), @ORM\Index(name="fk_Collection_ElementCollection1_idx", columns={"id_ElementCollection"})})
 * @ORM\Entity
 */
class Collection
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
     * @var \Categorie
     *
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Categorie", referencedColumnName="id")
     * })
     */
    private $idCategorie;

    /**
     * @var \Elementcollection
     *
     * @ORM\ManyToOne(targetEntity="Elementcollection")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ElementCollection", referencedColumnName="id")
     * })
     */
    private $idElementcollection;

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
     * @return \Categorie
     */
    public function getIdCategorie(): \Categorie
    {
        return $this->idCategorie;
    }

    /**
     * @param \Categorie $idCategorie
     */
    public function setIdCategorie(\Categorie $idCategorie): void
    {
        $this->idCategorie = $idCategorie;
    }

    /**
     * @return \Elementcollection
     */
    public function getIdElementcollection(): \Elementcollection
    {
        return $this->idElementcollection;
    }

    /**
     * @param \Elementcollection $idElementcollection
     */
    public function setIdElementcollection(\Elementcollection $idElementcollection): void
    {
        $this->idElementcollection = $idElementcollection;
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
