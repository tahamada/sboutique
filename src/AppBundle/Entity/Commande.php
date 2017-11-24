<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande", indexes={@ORM\Index(name="FK_Commande_Client_idx", columns={"idClient"})})
 * @ORM\Entity
 */
class Commande
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
     * @var boolean
     *
     * @ORM\Column(name="date", type="boolean", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=45, nullable=true)
     */
    private $etat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePrevue", type="datetime", nullable=true)
     */
    private $dateprevue;

    /**
     * @var integer
     *
     * @ORM\Column(name="dateRecue", type="integer", nullable=true)
     */
    private $daterecue;

    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idClient", referencedColumnName="id")
     * })
     */
    private $client;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Articlevendeur", inversedBy="commande")
     * @ORM\JoinTable(name="commandearticle",
     *   joinColumns={
     *     @ORM\JoinColumn(name="commande_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     *   }
     * )
     */
    private $article;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->article = new \Doctrine\Common\Collections\ArrayCollection();
    }


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
     * @param boolean $date
     *
     * @return Commande
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return boolean
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
     * @return Commande
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
     * Set dateprevue
     *
     * @param \DateTime $dateprevue
     *
     * @return Commande
     */
    public function setDateprevue($dateprevue)
    {
        $this->dateprevue = $dateprevue;

        return $this;
    }

    /**
     * Get dateprevue
     *
     * @return \DateTime
     */
    public function getDateprevue()
    {
        return $this->dateprevue;
    }

    /**
     * Set daterecue
     *
     * @param integer $daterecue
     *
     * @return Commande
     */
    public function setDaterecue($daterecue)
    {
        $this->daterecue = $daterecue;

        return $this;
    }

    /**
     * Get daterecue
     *
     * @return integer
     */
    public function getDaterecue()
    {
        return $this->daterecue;
    }

    /**
     * Set idclient
     *
     * @param \AppBundle\Entity\Client $idclient
     *
     * @return Commande
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
     * Add article
     *
     * @param \AppBundle\Entity\Articlevendeur $article
     *
     * @return Commande
     */
    public function addArticle(\AppBundle\Entity\Articlevendeur $article)
    {
        $this->article[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \AppBundle\Entity\Articlevendeur $article
     */
    public function removeArticle(\AppBundle\Entity\Articlevendeur $article)
    {
        $this->article->removeElement($article);
    }

    /**
     * Get article
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set client
     *
     * @param \AppBundle\Entity\Client $client
     *
     * @return Commande
     */
    public function setClient(\AppBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \AppBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }
}
