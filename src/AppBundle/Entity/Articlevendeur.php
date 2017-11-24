<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Articlevendeur
 *
 * @ORM\Table(name="articlevendeur", indexes={@ORM\Index(name="IDX_E900E9957294869C", columns={"article_id"}), @ORM\Index(name="IDX_E900E995858C065E", columns={"vendeur_id"})})
 * @ORM\Entity
 */
class Articlevendeur
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
     * @var integer
     *
     * @ORM\Column(name="payableNFois", type="integer", nullable=false)
     */
    private $payablenfois;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;

    /**
     * @var \Article
     *
     * @ORM\ManyToOne(targetEntity="Article",inversedBy="vendeurs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     * })
     */
    private $article;

    /**
     * @var \Vendeur
     *
     * @ORM\ManyToOne(targetEntity="Vendeur",inversedBy="articles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vendeur_id", referencedColumnName="id")
     * })
     */
    private $vendeur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Commande", mappedBy="article")
     */
    private $commande;


    /**
    * @ORM\OneToMany(targetEntity="Message", mappedBy="article")
    */
    private $commentaires;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->commande = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return Articlevendeur
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
     * Set payablenfois
     *
     * @param integer $payablenfois
     *
     * @return Articlevendeur
     */
    public function setPayablenfois($payablenfois)
    {
        $this->payablenfois = $payablenfois;

        return $this;
    }

    /**
     * Get payablenfois
     *
     * @return integer
     */
    public function getPayablenfois()
    {
        return $this->payablenfois;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Articlevendeur
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set article
     *
     * @param \AppBundle\Entity\Article $article
     *
     * @return Articlevendeur
     */
    public function setArticle(\AppBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \AppBundle\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set vendeur
     *
     * @param \AppBundle\Entity\Vendeur $vendeur
     *
     * @return Articlevendeur
     */
    public function setVendeur(\AppBundle\Entity\Vendeur $vendeur = null)
    {
        $this->vendeur = $vendeur;

        return $this;
    }

    /**
     * Get vendeur
     *
     * @return \AppBundle\Entity\Vendeur
     */
    public function getVendeur()
    {
        return $this->vendeur;
    }

    /**
     * Add commande
     *
     * @param \AppBundle\Entity\Commande $commande
     *
     * @return Articlevendeur
     */
    public function addCommande(\AppBundle\Entity\Commande $commande)
    {
        $this->commande[] = $commande;

        return $this;
    }

    /**
     * Remove commande
     *
     * @param \AppBundle\Entity\Commande $commande
     */
    public function removeCommande(\AppBundle\Entity\Commande $commande)
    {
        $this->commande->removeElement($commande);
    }

    /**
     * Get commande
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * Add commentaire
     *
     * @param \AppBundle\Entity\Message $commentaire
     *
     * @return Articlevendeur
     */
    public function addCommentaire(\AppBundle\Entity\Message $commentaire)
    {
        $this->commentaires[] = $commentaire;

        return $this;
    }

    /**
     * Remove commentaire
     *
     * @param \AppBundle\Entity\Message $commentaire
     */
    public function removeCommentaire(\AppBundle\Entity\Message $commentaire)
    {
        $this->commentaires->removeElement($commentaire);
    }

    /**
     * Get commentaires
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }
}
