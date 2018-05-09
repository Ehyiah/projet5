<?php

namespace App\\Entity;

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


}
