<?php

namespace App\Form;

use App\Entity\Ville;
use App\Entity\Departement;
use Doctrine\Common\Collections\ArrayCollection;


class SearchData
{
    /**
     * @Assert\Type(type="int")
     */
    private $nbChambres;
    private $acceptAnimaux;
    private $ville;
    private $departement;
    private $region;
    private $equipementInterieur;
    private $equipementExterieur;
    private $service;
    private $extendToDepartement;
    private ?bool $extendToRegion = null;

    public function getNbChambres(): ?int
    {
        return $this->nbChambres;
    }

    public function setNbChambres(int $nbChambres): self
    {
        $this->nbChambres = $nbChambres;
        return $this;
    }

    public function isAcceptAnimaux(): ?bool
    {
        return $this->acceptAnimaux;
    }

    public function setAcceptAnimaux(bool $acceptAnimaux): self
    {
        $this->acceptAnimaux = $acceptAnimaux;
        return $this;
    }

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): self
    {
        $this->ville = $ville;
        return $this;
    }

    public function getEquipementInterieur(): ?ArrayCollection
    {
        return $this->equipementInterieur;
    }

    public function setEquipementInterieur(?ArrayCollection $equipementInterieur): self
    {
        $this->equipementInterieur = $equipementInterieur;
        return $this;
    }

    public function getEquipementExterieur(): ?ArrayCollection
    {
        return $this->equipementExterieur;
    }

    public function setEquipementExterieur(?ArrayCollection $equipementExterieur): self
    {
        $this->equipementExterieur = $equipementExterieur;
        return $this;
    }

    public function getService(): ?ArrayCollection
    {
        return $this->service;
    }

    public function setService(?ArrayCollection $service): self
    {
        $this->service = $service;
        return $this;
    }

    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(?Departement $departement): self
    {
        $this->departement = $departement;
        return $this;
    }
    /**
     * Get the value of region
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set the value of region
     */
    public function setRegion($region): self
    {
        $this->region = $region;

        return $this;
    }

    public function isExtendToDepartement(): ?bool
    {
        return $this->extendToDepartement;
    }

    public function setExtendToDepartement(?bool $extendToDepartement): self
    {
        $this->extendToDepartement = $extendToDepartement;
        return $this;
    }

    public function isExtendToRegion(): ?bool
    {
        return $this->extendToRegion;
    }

    public function setExtendToRegion(?bool $extendToRegion): self
    {
        $this->extendToRegion = $extendToRegion;

        return $this;
    }
}
