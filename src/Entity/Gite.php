<?php

namespace App\Entity;

use App\Repository\GiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GiteRepository::class)]
class Gite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomGite = null;

    #[ORM\Column]
    private ?float $surface = null;

    #[ORM\Column]
    private ?int $nbChambres = null;

    #[ORM\Column]
    private ?int $nbLits = null;

    #[ORM\Column]
    private ?bool $acceptAnimaux = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 7, scale: 2, nullable: true)]
    private ?string $tarifAnimaux = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'gites')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ville $ville = null;

    #[ORM\ManyToOne(inversedBy: 'gites')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Proprietaire $proprietaire = null;

    #[ORM\ManyToOne(inversedBy: 'gites')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Contact $contact = null;

    #[ORM\ManyToOne(inversedBy: 'gites')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Prix $prix = null;

    #[ORM\ManyToMany(targetEntity: EquipementInterieur::class, inversedBy: 'gites')]
    private Collection $equipementInterieur;

    #[ORM\ManyToMany(targetEntity: EquipementExterieur::class, inversedBy: 'gites')]
    private Collection $equipementExterieur;

    #[ORM\ManyToMany(targetEntity: Service::class, inversedBy: 'gites')]
    private Collection $service;

    public function __construct()
    {
        $this->equipementInterieur = new ArrayCollection();
        $this->equipementExterieur = new ArrayCollection();
        $this->service = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomGite(): ?string
    {
        return $this->nomGite;
    }

    public function setNomGite(string $nomGite): self
    {
        $this->nomGite = $nomGite;

        return $this;
    }

    public function getSurface(): ?float
    {
        return $this->surface;
    }

    public function setSurface(float $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getNbChambres(): ?int
    {
        return $this->nbChambres;
    }

    public function setNbChambres(int $nbChambres): self
    {
        $this->nbChambres = $nbChambres;

        return $this;
    }

    public function getNbLits(): ?int
    {
        return $this->nbLits;
    }

    public function setNbLits(int $nbLits): self
    {
        $this->nbLits = $nbLits;

        return $this;
    }

    public function hasPool(): bool
    {
        $equipementsExterieurs = $this->getEquipementExterieur();

        foreach ($equipementsExterieurs as $equipementExterieur) {
            if ($equipementExterieur->getNom() === 'Piscine') {
                return true;
            }
        }

        return false;
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

    public function getTarifAnimaux(): ?string
    {
        return $this->tarifAnimaux;
    }

    public function setTarifAnimaux(?string $tarifAnimaux): self
    {
        $this->tarifAnimaux = $tarifAnimaux;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

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

    public function getProprietaire(): ?Proprietaire
    {
        return $this->proprietaire;
    }

    public function setproprietaire(?Proprietaire $proprietaire): self
    {
        $this->proprietaire = $proprietaire;

        return $this;
    }

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(?Contact $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getPrix(): ?Prix
    {
        return $this->prix;
    }

    public function setPrix(?Prix $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return Collection<int, EquipementInterieur>
     */
    public function getEquipementInterieur(): Collection
    {
        return $this->equipementInterieur;
    }

    public function addEquipementInterieur(EquipementInterieur $equipementInterieur): self
    {
        if (!$this->equipementInterieur->contains($equipementInterieur)) {
            $this->equipementInterieur->add($equipementInterieur);
        }

        return $this;
    }

    public function removeEquipementInterieur(EquipementInterieur $equipementInterieur): self
    {
        $this->equipementInterieur->removeElement($equipementInterieur);

        return $this;
    }

    /**
     * @return Collection<int, EquipementExterieur>
     */
    public function getEquipementExterieur(): Collection
    {
        return $this->equipementExterieur;
    }

    public function addEquipementExterieur(EquipementExterieur $equipementExterieur): self
    {
        if (!$this->equipementExterieur->contains($equipementExterieur)) {
            $this->equipementExterieur->add($equipementExterieur);
        }

        return $this;
    }

    public function removeEquipementExterieur(EquipementExterieur $equipementExterieur): self
    {
        $this->equipementExterieur->removeElement($equipementExterieur);

        return $this;
    }

    /**
     * @return Collection<int, Service>
     */
    public function getService(): Collection
    {
        return $this->service;
    }

    public function addService(Service $service): self
    {
        if (!$this->service->contains($service)) {
            $this->service->add($service);
        }

        return $this;
    }

    public function removeService(Service $service): self
    {
        $this->service->removeElement($service);

        return $this;
    }
}
