<?php

namespace App\\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pret
 *
 * @ORM\Table(name="pret")
 * @ORM\Entity
 */
class Pret
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
     * @var int|null
     *
     * @ORM\Column(name="id_User_Emprunteur", type="integer", nullable=true)
     */
    private $idUserEmprunteur;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_User_Preteur", type="integer", nullable=true)
     */
    private $idUserPreteur;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_ElementCollection", type="integer", nullable=true)
     */
    private $idElementcollection;


}
