<?php

namespace App\Entity;

use App\Repository\AffaireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AffaireRepository::class)]
class Affaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomAffaire = null;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'affaires')]
    #[ORM\JoinColumn(name: 'client_id', referencedColumnName: 'id')]
    private ?Client $client = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\OneToMany(mappedBy: 'affaire', targetEntity: Doe::class, orphanRemoval: true)]
    private Collection $does;

    public function __construct()
    {
        $this->does = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAffaire(): ?string
    {
        return $this->nomAffaire;
    }

    public function setNomAffaire(string $nomAffaire): static
    {
        $this->nomAffaire = $nomAffaire;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * @return Collection<int, Doe>
     */
    public function getDoes(): Collection
    {
        return $this->does;
    }

    public function addDoe(Doe $doe): static
    {
        if (!$this->does->contains($doe)) {
            $this->does->add($doe);
            $doe->setAffaire($this);
        }

        return $this;
    }

    public function removeDoe(Doe $doe): static
    {
        if ($this->does->removeElement($doe)) {
            // set the owning side to null (unless already changed)
            if ($doe->getAffaire() === $this) {
                $doe->setAffaire(null);
            }
        }

        return $this;
    }
}
