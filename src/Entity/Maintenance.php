<?php

namespace App\Entity;

use App\Repository\MaintenanceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaintenanceRepository::class)]
class Maintenance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Doe::class)]
    #[ORM\JoinColumn(name: 'doe_id', referencedColumnName: 'id', nullable: false)]
    private ?Doe $doe = null;

    #[ORM\ManyToOne(targetEntity: Affaire::class)]
    #[ORM\JoinColumn(name: 'affaire_id', referencedColumnName: 'id', nullable: false)]
    private ?Affaire $affaire = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255, options: ['default' => 'Pas_commence'])]
    private ?string $etat = 'Pas_commence';

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $motifBlocage = null;

    #[ORM\ManyToOne(targetEntity: Agent::class)]
    #[ORM\JoinColumn(name: 'responsable', referencedColumnName: 'matricule')]
    private ?Agent $responsable = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $dateFin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDoe(): ?Doe
    {
        return $this->doe;
    }

    public function setDoe(?Doe $doe): static
    {
        $this->doe = $doe;

        return $this;
    }

    public function getAffaire(): ?Affaire
    {
        return $this->affaire;
    }

    public function setAffaire(?Affaire $affaire): static
    {
        $this->affaire = $affaire;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): static
    {
        $this->etat = $etat;

        return $this;
    }

    public function getMotifBlocage(): ?string
    {
        return $this->motifBlocage;
    }

    public function setMotifBlocage(?string $motifBlocage): static
    {
        $this->motifBlocage = $motifBlocage;

        return $this;
    }

    public function getResponsable(): ?Agent
    {
        return $this->responsable;
    }

    public function setResponsable(?Agent $responsable): static
    {
        $this->responsable = $responsable;

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
}
