<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Elementcollection
 *
 * @ORM\Table(name="elementcollection")
 * @ORM\Entity
 */
class Elementcollection
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
     * @ORM\Column(name="Titre", type="string", length=45, nullable=false)
     */
    private $titre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Image", type="blob", length=65535, nullable=true)
     */
    private $image;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Region", type="string", length=45, nullable=true)
     */
    private $region;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Auteur", type="string", length=45, nullable=true)
     */
    private $auteur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Editeur", type="string", length=45, nullable=true)
     */
    private $editeur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Etat", type="string", length=45, nullable=true)
     */
    private $etat;

    /**
     * @var int|null
     *
     * @ORM\Column(name="PrixAchat", type="integer", nullable=true)
     */
    private $prixachat;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Support", type="string", length=45, nullable=true)
     */
    private $support;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NbreJoueurs", type="integer", nullable=true)
     */
    private $nbrejoueurs;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Valeur", type="integer", nullable=true)
     */
    private $valeur;






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
    public function getTitre(): string
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

    /**
     * @return null|string
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param null|string $image
     */
    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return null|string
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * @param null|string $region
     */
    public function setRegion(?string $region): void
    {
        $this->region = $region;
    }

    /**
     * @return null|string
     */
    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    /**
     * @param null|string $auteur
     */
    public function setAuteur(?string $auteur): void
    {
        $this->auteur = $auteur;
    }

    /**
     * @return null|string
     */
    public function getEditeur(): ?string
    {
        return $this->editeur;
    }

    /**
     * @param null|string $editeur
     */
    public function setEditeur(?string $editeur): void
    {
        $this->editeur = $editeur;
    }

    /**
     * @return null|string
     */
    public function getEtat(): ?string
    {
        return $this->etat;
    }

    /**
     * @param null|string $etat
     */
    public function setEtat(?string $etat): void
    {
        $this->etat = $etat;
    }

    /**
     * @return int|null
     */
    public function getPrixachat(): ?int
    {
        return $this->prixachat;
    }

    /**
     * @param int|null $prixachat
     */
    public function setPrixachat(?int $prixachat): void
    {
        $this->prixachat = $prixachat;
    }

    /**
     * @return null|string
     */
    public function getSupport(): ?string
    {
        return $this->support;
    }

    /**
     * @param null|string $support
     */
    public function setSupport(?string $support): void
    {
        $this->support = $support;
    }

    /**
     * @return int|null
     */
    public function getNbrejoueurs(): ?int
    {
        return $this->nbrejoueurs;
    }

    /**
     * @param int|null $nbrejoueurs
     */
    public function setNbrejoueurs(?int $nbrejoueurs): void
    {
        $this->nbrejoueurs = $nbrejoueurs;
    }

    /**
     * @return int|null
     */
    public function getValeur(): ?int
    {
        return $this->valeur;
    }

    /**
     * @param int|null $valeur
     */
    public function setValeur(?int $valeur): void
    {
        $this->valeur = $valeur;
    }



}
