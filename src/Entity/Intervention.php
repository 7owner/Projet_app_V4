<?php

namespace App\Entity;

use App\Repository\InterventionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InterventionRepository::class)]
class Intervention
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Maintenance::class)]
    #[ORM\JoinColumn(name: 'maintenance_id', referencedColumnName: 'id', nullable: false)]
    private ?Maintenance $maintenance = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\ManyToOne(targetEntity: self::class)]
    #[ORM\JoinColumn(name: 'intervention_precedente_id', referencedColumnName: 'id')]
    private ?self $interventionPrecedente = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $dateDebutTs = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $dateFinTs = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMaintenance(): ?Maintenance
    {
        return $this->maintenance;
    }

    public function setMaintenance(?Maintenance $maintenance): static
    {
        $this->maintenance = $maintenance;

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

    public function setDateFin(?\DateTimeInterface $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getInterventionPrecedente(): ?self
    {
        return $this->interventionPrecedente;
    }

    public function setInterventionPrecedente(?self $interventionPrecedente): static
    {
        $this->interventionPrecedente = $interventionPrecedente;

        return $this;
    }

    public function getDateDebutTs(): ?\DateTimeInterface
    {
        return $this->dateDebutTs;
    }

    public function setDateDebutTs(\DateTimeInterface $dateDebutTs): static
    {
        $this->dateDebutTs = $dateDebutTs;

        return $this;
    }

    public function getDateFinTs(): ?\DateTimeInterface
    {
        return $this->dateFinTs;
    }

    public function setDateFinTs(\DateTimeInterface $dateFinTs): static
    {
        $this->dateFinTs = $dateFinTs;

        return $this;
    }
}
