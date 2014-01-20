<?php

namespace Newstore\CamionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Camion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Newstore\CamionBundle\Entity\CamionRepository")
 */
class Camion {

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
     * @ORM\Column(name="conducteurName", type="string", length=255)
     */
    private $conducteurName;

    /**
     * @var string
     *
     * @ORM\Column(name="conducteurPrenom", type="string", length=255)
     */
    private $conducteurPrenom;

    /**
     * @var string
     *
     * @ORM\Column(name="conducteurAdresse", type="string", length=255)
     */
    private $conducteurAdresse;

    /**
     * @var string
     *
     * @ORM\Column(name="conducteurCodePostal", type="string", length=255)
     */
    private $conducteurCodePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="conducteurVille", type="string", length=255)
     */
    private $conducteurVille;

    /**
     * @var string
     *
     * @ORM\Column(name="conducteurTelephone", type="string", length=255)
     */
    private $conducteurTelephone;

    /**
     * @var string
     *
     * @ORM\Column(name="capaciteVolume", type="string", length=255)
     */
    private $capaciteVolume;

    /**
     * @var string
     *
     * @ORM\Column(name="immatriculation", type="string", length=255)
     */
    private $immatriculation;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set conducteurName
     *
     * @param string $conducteurName
     * @return Camion
     */
    public function setConducteurName($conducteurName) {
        $this->conducteurName = $conducteurName;

        return $this;
    }

    /**
     * Get conducteurName
     *
     * @return string 
     */
    public function getConducteurName() {
        return $this->conducteurName;
    }

    /**
     * Set conducteurPrenom
     *
     * @param string $conducteurPrenom
     * @return Camion
     */
    public function setConducteurPrenom($conducteurPrenom) {
        $this->conducteurPrenom = $conducteurPrenom;

        return $this;
    }

    /**
     * Get conducteurPrenom
     *
     * @return string 
     */
    public function getConducteurPrenom() {
        return $this->conducteurPrenom;
    }

    /**
     * Set conducteurAdresse
     *
     * @param string $conducteurAdresse
     * @return Camion
     */
    public function setConducteurAdresse($conducteurAdresse) {
        $this->conducteurAdresse = $conducteurAdresse;

        return $this;
    }

    /**
     * Get conducteurAdresse
     *
     * @return string 
     */
    public function getConducteurAdresse() {
        return $this->conducteurAdresse;
    }

    /**
     * Set conducteurCodePostal
     *
     * @param string $conducteurCodePostal
     * @return Camion
     */
    public function setConducteurCodePostal($conducteurCodePostal) {
        $this->conducteurCodePostal = $conducteurCodePostal;

        return $this;
    }

    /**
     * Get conducteurCodePostal
     *
     * @return string 
     */
    public function getConducteurCodePostal() {
        return $this->conducteurCodePostal;
    }

    /**
     * Set conducteurVille
     *
     * @param string $conducteurVille
     * @return Camion
     */
    public function setConducteurVille($conducteurVille) {
        $this->conducteurVille = $conducteurVille;

        return $this;
    }

    /**
     * Get conducteurVille
     *
     * @return string 
     */
    public function getConducteurVille() {
        return $this->conducteurVille;
    }

    /**
     * Set capaciteVolume
     *
     * @param string $capaciteVolume
     * @return Camion
     */
    public function setCapaciteVolume($capaciteVolume) {
        $this->capaciteVolume = $capaciteVolume;

        return $this;
    }

    /**
     * Get capaciteVolume
     *
     * @return string 
     */
    public function getCapaciteVolume() {
        return $this->capaciteVolume;
    }

    /**
     * Set conducteurTelephone
     *
     * @param string $conducteurTelephone
     * @return Camion
     */
    public function setConducteurTelephone($conducteurTelephone) {
        $this->conducteurTelephone = $conducteurTelephone;

        return $this;
    }

    /**
     * Get conducteurTelephone
     *
     * @return string 
     */
    public function getConducteurTelephone() {
        return $this->conducteurTelephone;
    }

    /**
     * Set immatriculation
     *
     * @param string $immatriculation
     * @return Camion
     */
    public function setImmatriculation($immatriculation) {
        $this->immatriculation = $immatriculation;

        return $this;
    }

    /**
     * Get immatriculation
     *
     * @return string 
     */
    public function getImmatriculation() {
        return $this->immatriculation;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->camions = new \Doctrine\Common\Collections\ArrayCollection();
    }
}