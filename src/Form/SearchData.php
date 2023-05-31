<?php

namespace App\Data;

use App\Entity\Ville;
use Doctrine\Common\Collections\ArrayCollection;


class SearchData
{
    private $nbChambres;
    private $acceptAnimaux;
    private $ville;
    private $equipementInterieur;
    private $equipementExterieur;
    private $service;

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
}
