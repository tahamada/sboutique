<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommandeArticle
 *
 * @ORM\Table(name="commande_article", indexes={@ORM\Index(name="IDX_F4817CC682EA2E54", columns={"commande_id"}), @ORM\Index(name="IDX_F4817CC67294869C", columns={"article_id"})})
 * @ORM\Entity
 */
class CommandeArticle
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
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePrevue", type="datetime", nullable=true)
     */
    private $dateprevue;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateRecue", type="datetime", nullable=true)
     */
    private $daterecue;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255, nullable=true)
     */
    private $etat;

    /**
     * @var \Articlevendeur
     *
     * @ORM\ManyToOne(targetEntity="Articlevendeur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     * })
     */
    private $article;

    /**
     * @var \Commande
     *
     * @ORM\ManyToOne(targetEntity="Commande")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="commande_id", referencedColumnName="id")
     * })
     */
    private $commande;



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
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return CommandeArticle
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set dateprevue
     *
     * @param \DateTime $dateprevue
     *
     * @return CommandeArticle
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
     * @param \DateTime $daterecue
     *
     * @return CommandeArticle
     */
    public function setDaterecue($daterecue)
    {
        $this->daterecue = $daterecue;

        return $this;
    }

    /**
     * Get daterecue
     *
     * @return \DateTime
     */
    public function getDaterecue()
    {
        return $this->daterecue;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return CommandeArticle
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
     * Set article
     *
     * @param \AppBundle\Entity\Articlevendeur $article
     *
     * @return CommandeArticle
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
     * Set commande
     *
     * @param \AppBundle\Entity\Commande $commande
     *
     * @return CommandeArticle
     */
    public function setCommande(\AppBundle\Entity\Commande $commande = null)
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * Get commande
     *
     * @return \AppBundle\Entity\Commande
     */
    public function getCommande()
    {
        return $this->commande;
    }
}
