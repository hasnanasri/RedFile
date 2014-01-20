<?php

namespace Newstore\LivraisonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Livraison
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Newstore\LivraisonBundle\Entity\LivraisonRepository")
 */
class Livraison {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Newstore\MagasinBundle\Entity\Magasin")
     * @ORM\JoinColumn(nullable=false)
     */
    private $magasin;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=255)
     */
    private $reference;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var \DateTime
     * 
     * @ORM\Column(name="dateModification", type="datetime")
     */
    private $dateModification;

    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=255)
     */
    private $statut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateLivraison", type="datetime")
     */
    private $dateLivraison;

    /**
     * @ORM\OneToMany(targetEntity="Newstore\LivraisonBundle\Entity\LivraisonProduit", mappedBy="produit", cascade={"remove", "refresh", "persist"})
     */
    private $produits;

    public function __construct() {
        $this->dateCreation = new \Datetime();
        $this->dateModification = new \Datetime();
        $this->produits = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set reference
     *
     * @param string $reference
     * @return Livraison
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
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Livraison
     */
    public function setDateCreation($dateCreation) {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime 
     */
    public function getDateCreation() {
        return $this->dateCreation;
    }

    /**
     * Set dateModification
     *
     * @param \DateTime $dateModification
     * @return Livraison
     */
    public function setDateModification($dateModification) {
        $this->dateModification = $dateModification;

        return $this;
    }

    /**
     * Get dateModification
     * @ORM\preUpdate
     * @return \DateTime 
     */
    public function getDateModification() {
        return $this->dateModification;
    }

    /**
     * Set statut
     *
     * @param string $statut
     * @return Livraison
     */
    public function setStatut($statut) {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string 
     */
    public function getStatut() {
        return $this->statut;
    }

    /**
     * Set dateLivraison
     *
     * @param \DateTime $dateLivraison
     * @return Livraison
     */
    public function setDateLivraison($dateLivraison) {
        $this->dateLivraison = $dateLivraison;

        return $this;
    }

    /**
     * Get dateLivraison
     *
     * @return \DateTime 
     */
    public function getDateLivraison() {
        return $this->dateLivraison;
    }

    /**
     * Set magasin
     *
     * @param \Newstore\MagasinBundle\Entity\Magasin $magasin
     * @return Livraison
     */
    public function setMagasin(\Newstore\MagasinBundle\Entity\Magasin $magasin) {
        $this->magasin = $magasin;

        return $this;
    }

    /**
     * Get magasin
     *
     * @return \Newstore\MagasinBundle\Entity\Magasin 
     */
    public function getMagasin() {
        return $this->magasin;
    }

    /**
     * Add produits
     *
     * @param \Newstore\LivraisonBundle\Entity\LivraisonProduit $produits
     * @return Livraison
     */
    public function addProduit(\Newstore\LivraisonBundle\Entity\LivraisonProduit $produits) {
        $this->produits[] = $produits;

        return $this;
    }

    /**
     * Remove produits
     *
     * @param \Newstore\LivraisonBundle\Entity\LivraisonProduit $produits
     */
    public function removeProduit(\Newstore\LivraisonBundle\Entity\LivraisonProduit $produits) {
        $this->produits->removeElement($produits);
    }

    /**
     * Get produits
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProduits() {
        return $this->produits;
    }


}