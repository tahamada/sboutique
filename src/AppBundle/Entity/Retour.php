<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Retour
 *
 * @ORM\Table(name="retour", indexes={@ORM\Index(name="FK_Retour_Article_idx", columns={"idArticle"}), @ORM\Index(name="FK_Retour_Client_idx", columns={"idClient"})})
 * @ORM\Entity
 */
class Retour
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=45, nullable=true)
     */
    private $etat;

    /**
     * @var \Article
     *
     * @ORM\ManyToOne(targetEntity="Article")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idArticle", referencedColumnName="id")
     * })
     */
    private $idarticle;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Retour
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Retour
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set idarticle
     *
     * @param \AppBundle\Entity\Article $idarticle
     *
     * @return Retour
     */
    public function setIdarticle(\AppBundle\Entity\Article $idarticle = null)
    {
        $this->idarticle = $idarticle;

        return $this;
    }

    /**
     * Get idarticle
     *
     * @return \AppBundle\Entity\Article
     */
    public function getIdarticle()
    {
        return $this->idarticle;
    }

    /**
     * Set idclient
     *
     * @param \AppBundle\Entity\Client $idclient
     *
     * @return Retour
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
}
