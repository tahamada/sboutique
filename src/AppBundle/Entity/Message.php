<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="message", indexes={@ORM\Index(name="FK_Message_Article_idx", columns={"idArticle"}), @ORM\Index(name="FK_Message_Vendeur_idx", columns={"idPersonne"})})
 * @ORM\Entity
 */
class Message
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
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text", nullable=true)
     */
    private $contenu;

    /**
     * @var boolean
     *
     * @ORM\Column(name="vendeur", type="boolean", nullable=true)
     */
    private $vendeur;

    /**
     * @var boolean
     *
     * @ORM\Column(name="reclamation", type="boolean", nullable=true)
     */
    private $reclamation;

    /**
     * @var boolean
     *
     * @ORM\Column(name="visible", type="boolean", nullable=false)
     */
    private $visible;

    /**
     * @var \Article
     *
     * @ORM\ManyToOne(targetEntity="Articlevendeur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idArticle", referencedColumnName="id")
     * })
     */
    private $article;

    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idPersonne", referencedColumnName="id")
     * })
     */
    private $Client;



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
     * @return Message
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
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Message
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set vendeur
     *
     * @param boolean $vendeur
     *
     * @return Message
     */
    public function setVendeur($vendeur)
    {
        $this->vendeur = $vendeur;

        return $this;
    }

    /**
     * Get vendeur
     *
     * @return boolean
     */
    public function getVendeur()
    {
        return $this->vendeur;
    }

    /**
     * Set reclamation
     *
     * @param boolean $reclamation
     *
     * @return Message
     */
    public function setReclamation($reclamation)
    {
        $this->reclamation = $reclamation;

        return $this;
    }

    /**
     * Get reclamation
     *
     * @return boolean
     */
    public function getReclamation()
    {
        return $this->reclamation;
    }

    /**
     * Set visible
     *
     * @param boolean $visible
     *
     * @return Message
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get visible
     *
     * @return boolean
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Set idarticle
     *
     * @param \AppBundle\Entity\Article $idarticle
     *
     * @return Message
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
     * Set article
     *
     * @param \AppBundle\Entity\Articlevendeur $article
     *
     * @return Message
     */
    public function setArticle(\AppBundle\Entity\Articlevendeur $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \AppBundle\Entity\Articlevendeur
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
     * @return Message
     */
    public function setClient(\AppBundle\Entity\Client $client = null)
    {
        $this->Client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \AppBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->Client;
    }
}
