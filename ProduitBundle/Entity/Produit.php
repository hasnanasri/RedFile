<?php

namespace Newstore\ProduitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Newstore\ProduitBundle\Entity\ProduitRepository")
 */
class Produit {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="string", length=255)
     */
    private $designation;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=255)
     */
    private $reference;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="decimal")
     */
    private $prix;

    /**
     * @var integer
     *
     * @ORM\Column(name="stockReel", type="integer")
     */
    private $stockReel;

    /**
     * @var integer
     *
     * @ORM\Column(name="stockDisponible", type="integer")
     */
    private $stockDisponible;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="volume", type="integer")
     */
    private $volume;

    /**
     * @ORM\ManyToOne(targetEntity="Newstore\FournisseurBundle\Entity\Fournisseur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fournisseur;

    /**
     * @ORM\ManyToOne(targetEntity="Newstore\CategorieBundle\Entity\Categorie")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;
    
    /**
     * @ORM\ManyToOne(targetEntity="Newstore\ZoneBundle\Entity\Zone")
     * @ORM\JoinColumn(nullable=false)
     */
    private $zone;
    
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set designation
     *
     * @param string $designation
     * @return Produit
     */
    public function setDesignation($designation) {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string 
     */
    public function getDesignation() {
        return $this->designation;
    }

    /**
     * Set reference
     *
     * @param string $reference
     * @return Produit
     */
    public function setReference($reference) {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string 
     */
    public function getReference() {
        return $this->reference;
    }

    /**
     * Set prix
     *
     * @param float $prix
     * @return Produit
     */
    public function setPrix($prix) {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float 
     */
    public function getPrix() {
        return $this->prix;
    }

    /**
     * Set stockReel
     *
     * @param integer $stockReel
     * @return Produit
     */
    public function setStockReel($stockReel) {
        $this->stockReel = $stockReel;

        return $this;
    }

    /**
     * Get stockReel
     *
     * @return integer 
     */
    public function getStockReel() {
        return $this->stockReel;
    }

    /**
     * Set stockDisponible
     *
     * @param integer $stockDisponible
     * @return Produit
     */
    public function setStockDisponible($stockDisponible) {
        $this->stockDisponible = $stockDisponible;

        return $this;
    }

    /**
     * Get stockDisponible
     *
     * @return integer 
     */
    public function getStockDisponible() {
        return $this->stockDisponible;
    }

    /**
     * Set fournisseur
     *
     * @param Newstore\FournisseurBundle\Entity\Fournisseur $fournisseur
     */
    public function setArticle(\Newstore\FournisseurBundle\Entity\Fournisseur $fournisseur) {
        $this->fournisseur = $fournisseur;
    }

    /**
     * Get fournisseur
     *
     * @return Newstore\FournisseurBundle\Entity\Fournisseur
     */
    public function getFournisseur() {
        return $this->fournisseur;
    }

    /**
     * Set fournisseur
     *
     * @param \Newstore\FournisseurBundle\Entity\Fournisseur $fournisseur
     * @return Produit
     */
    public function setFournisseur(\Newstore\FournisseurBundle\Entity\Fournisseur $fournisseur) {
        $this->fournisseur = $fournisseur;

        return $this;
    }


  

    /**
     * Set categorie
     *
     * @param \Newstore\CategorieBundle\Entity\Categorie $categorie
     * @return Produit
     */
    public function setCategorie(\Newstore\CategorieBundle\Entity\Categorie $categorie)
    {
        $this->categorie = $categorie;
    
        return $this;
    }

    /**
     * Get categorie
     *
     * @return \Newstore\CategorieBundle\Entity\Categorie 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set zone
     *
     * @param \Newstore\ZoneBundle\Entity\Zone $zone
     * @return Produit
     */
    public function setZone(\Newstore\ZoneBundle\Entity\Zone $zone)
    {
        $this->zone = $zone;
    
        return $this;
    }

    /**
     * Get zone
     *
     * @return \Newstore\ZoneBundle\Entity\Zone 
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * Set volume
     *
     * @param integer $volume
     * @return Produit
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;
    
        return $this;
    }

    /**
     * Get volume
     *
     * @return integer 
     */
    public function getVolume()
    {
        return $this->volume;
    }
}