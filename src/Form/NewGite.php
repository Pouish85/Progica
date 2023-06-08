<?php

namespace App\Form;

use App\Entity\Ville;
use App\Entity\Departement;
use Doctrine\Common\Collections\ArrayCollection;

class NewGite
{
    public $nbChambres;
    public $acceptAnimaux;
    public $ville;
    public $departement;
    public $region;
    public $equipementInterieur;
    public $equipementExterieur;
    public $service;
    public $prix;
    public $nomGite;
    public $surface;
    public $nbLits;
    public $tarifAnimaux;
    public $image;
    public $proprietaire;
    public $contact;
    public $nouvelleVilleNom;

    public function getNbChambres(): ?int
    {
        return $this->nbChambres;
    }

    public function setNbChambres(?int $nbChambres): self
    {
        $this->nbChambres = $nbChambres;
        return $this;
    }

    public function isAcceptAnimaux(): ?bool
    {
        return $this->acceptAnimaux;
    }

    public function setAcceptAnimaux(?bool $acceptAnimaux): self
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

    public function getRegion()
    {
        return $this->region;
    }

    public function setRegion($region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function setPrix($prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getNomGite()
    {
        return $this->nomGite;
    }

    public function setNomGite($nomGite): self
    {
        $this->nomGite = $nomGite;

        return $this;
    }

    public function getSurface()
    {
        return $this->surface;
    }

    public function setSurface($surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getNbLits()
    {
        return $this->nbLits;
    }

    public function setNbLits($nbLits): self
    {
        $this->nbLits = $nbLits;

        return $this;
    }

    public function getTarifAnimaux()
    {
        return $this->tarifAnimaux;
    }

    public function setTarifAnimaux($tarifAnimaux): self
    {
        $this->tarifAnimaux = $tarifAnimaux;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getProprietaire()
    {
        return $this->proprietaire;
    }

    public function setProprietaire($proprietaire): self
    {
        $this->proprietaire = $proprietaire;

        return $this;
    }

    public function getContact()
    {
        return $this->contact;
    }

    public function setContact($contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get the value of nouvelleVilleNom
     */
    public function getNouvelleVilleNom()
    {
        return $this->nouvelleVilleNom;
    }

    /**
     * Set the value of nouvelleVilleNom
     */
    public function setNouvelleVilleNom($nouvelleVilleNom): self
    {
        $this->nouvelleVilleNom = $nouvelleVilleNom;

        return $this;
    }
}
