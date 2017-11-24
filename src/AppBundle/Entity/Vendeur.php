<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vendeur
 *
 * @ORM\Table(name="vendeur", indexes={@ORM\Index(name="FK_Vendeur_Client", columns={"idClient"})})
 * @ORM\Entity
 */
class Vendeur
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
     * @var string
     *
     * @ORM\Column(name="adresseVendeur", type="string", length=255, nullable=true)
     */
    private $adressevendeur;

    /**
     * @var string
     *
     * @ORM\Column(name="nomVendeur", type="string", length=255, nullable=true)
     */
    private $nomvendeur;

    /**
     * @var \Client
     *
     * @ORM\OneToOne(targetEntity="Client",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idClient", referencedColumnName="id")
     * })
     */
    private $client;



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
     * Set adressevendeur
     *
     * @param string $adressevendeur
     *
     * @return Vendeur
     */
    public function setAdressevendeur($adressevendeur)
    {
        $this->adressevendeur = $adressevendeur;

        return $this;
    }

    /**
     * Get adressevendeur
     *
     * @return string
     */
    public function getAdressevendeur()
    {
        return $this->adressevendeur;
    }

    /**
     * Set nomvendeur
     *
     * @param string $nomvendeur
     *
     * @return Vendeur
     */
    public function setNomvendeur($nomvendeur)
    {
        $this->nomvendeur = $nomvendeur;

        return $this;
    }

    /**
     * Get nomvendeur
     *
     * @return string
     */
    public function getNomvendeur()
    {
        return $this->nomvendeur;
    }

    
    /**
     * Set client
     *
     * @param \AppBundle\Entity\Client $client
     *
     * @return Vendeur
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
