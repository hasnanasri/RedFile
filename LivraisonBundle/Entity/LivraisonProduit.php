<?php

namespace Newstore\LivraisonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Newstore\ProduitBundle\Entity\Produit;
use Newstore\LivraisonBundle\Entity\Livraison;

/**
 * LivraisonProduit
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Newstore\LivraisonBundle\Entity\LivraisonProduitRepository")
 */
class LivraisonProduit {

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Newstore\LivraisonBundle\Entity\Livraison")
     */
    private $livraison;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Newstore\ProduitBundle\Entity\Produit")
     */
    private $produit;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite;
    
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     * @return LivraisonProduit
     */
    public function setQuantite($quantite) {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer 
     */
    public function getQuantite() {
        return $this->quantite;
    }


    /**
     * Set livraison
     *
     * @param \Newstore\LivraisonBundle\Entity\Livraison $livraison
     * @return LivraisonProduit
     */
    public function setLivraison(\Newstore\LivraisonBundle\Entity\Livraison $livraison)
    {
        $this->livraison = $livraison;
    
        return $this;
    }

    /**
     * Get livraison
     *
     * @return \Newstore\LivraisonBundle\Entity\Livraison 
     */
    public function getLivraison()
    {
        return $this->livraison;
    }

    /**
     * Set produit
     *
     * @param \Newstore\ProduitBundle\Entity\Produit $produit
     * @return LivraisonProduit
     */
    public function setProduit(\Newstore\ProduitBundle\Entity\Produit $produit)
    {
        $this->produit = $produit;
    
        return $this;
    }

    /**
     * Get produit
     *
     * @return \Newstore\ProduitBundle\Entity\Produit 
     */
    public function getProduit()
    {
        return $this->produit;
    }
}