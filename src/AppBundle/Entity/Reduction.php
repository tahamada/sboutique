<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reduction
 *
 * @ORM\Table(name="reduction", indexes={@ORM\Index(name="FK_Reduction_Categorie_idx", columns={"idCategorie"}), @ORM\Index(name="FK_Reduction_Client_idx", columns={"idClient"})})
 * @ORM\Entity
 */
class Reduction
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="pourcentage", type="float", precision=10, scale=0, nullable=false)
     */
    private $pourcentage;

    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idClient", referencedColumnName="id")
     * })
     */
    private $idclient;

    /**
     * @var \Categorie
     *
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCategorie", referencedColumnName="id")
     * })
     */
    private $idcategorie;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set pourcentage
     *
     * @param float $pourcentage
     *
     * @return Reduction
     */
    public function setPourcentage($pourcentage)
    {
        $this->pourcentage = $pourcentage;

        return $this;
    }

    /**
     * Get pourcentage
     *
     * @return float
     */
    public function getPourcentage()
    {
        return $this->pourcentage;
    }

    /**
     * Set idclient
     *
     * @param \AppBundle\Entity\Client $idclient
     *
     * @return Reduction
     */
    public function setIdclient(\AppBundle\Entity\Client $idclient = null)
    {
        $this->idclient = $idclient;

        return $this;
    }

    /**
     * Get idclient
     *
     * @return \AppBundle\Entity\Client
     */
    public function getIdclient()
    {
        return $this->idclient;
    }

    /**
     * Set idcategorie
     *
     * @param \AppBundle\Entity\Categorie $idcategorie
     *
     * @return Reduction
     */
    public function setIdcategorie(\AppBundle\Entity\Categorie $idcategorie = null)
    {
        $this->idcategorie = $idcategorie;

        return $this;
    }

    /**
     * Get idcategorie
     *
     * @return \AppBundle\Entity\Categorie
     */
    public function getIdcategorie()
    {
        return $this->idcategorie;
    }
}
