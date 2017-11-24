<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Article
 *
 * @ORM\Table(name="article", indexes={@ORM\Index(name="FK_Article_Categorie_idx", columns={"idCategorie"})})
 * @Vich\Uploadable
 * @ORM\Entity
 */
class Article
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
     * @ORM\Column(name="designation", type="string", length=255, nullable=false)
     */
    private $designation;

    /**
     * @var string
     *
     * @ORM\Column(name="imageUrl", type="string", length=255, nullable=true)
     */
    private $imageurl;

    /**
     * @Vich\UploadableField(mapping="images_produits", fileNameProperty="imageurl")
     * @var File
     */
    private $imageFile;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var \Categorie
     *
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCategorie", referencedColumnName="id")
     * })
     */
    private $categorie;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Articlevendeur",mappedBy="article")
     * 
     */
    private $vendeurs; 

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
     * Set designation
     *
     * @param string $designation
     *
     * @return Article
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set imageurl
     *
     * @param string $imageurl
     *
     * @return Article
     */
    public function setImageurl($imageurl)
    {
        $this->imageurl = $imageurl;

        return $this;
    }

    /**
     * Get imageurl
     *
     * @return string
     */
    public function getImageurl()
    {
        return $this->imageurl;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Article
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    

    /**
     * Set categorie
     *
     * @param \AppBundle\Entity\Categorie $categorie
     *
     * @return Article
     */
    public function setCategorie(\AppBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \AppBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param File $imageFile
     *
     * @return self
     */
    public function setImageFile($imageFile)
    {
        $this->imageFile = $imageFile;

        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVendeurs()
    {
        return $this->vendeurs;
    }

    
    /**
     * @param \Doctrine\Common\Collections\Collection $vendeurs
     *
     * @return self
     */
    public function setVendeurs($vendeurs)
    {
        $this->vendeurs = $vendeurs;

        return $this;
    }

    public function __toString(){
        return $this->getDesignation();
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->vendeurs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add vendeur
     *
     * @param \AppBundle\Entity\Articlevendeur $vendeur
     *
     * @return Article
     */
    public function addVendeur(\AppBundle\Entity\Articlevendeur $vendeur)
    {
        $this->vendeurs[] = $vendeur;

        return $this;
    }

    /**
     * Remove vendeur
     *
     * @param \AppBundle\Entity\Articlevendeur $vendeur
     */
    public function removeVendeur(\AppBundle\Entity\Articlevendeur $vendeur)
    {
        $this->vendeurs->removeElement($vendeur);
    }
}
