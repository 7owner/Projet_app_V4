<?php

namespace App\Entity;

use App\Repository\RapportMaintenanceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RapportMaintenanceRepository::class)]
#[ORM\Table(name: 'rapport_maintenance')]
class RapportMaintenance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Maintenance::class)]
    #[ORM\JoinColumn(name: 'maintenance_id', referencedColumnName: 'id', nullable: false)]
    private ?Maintenance $maintenance = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $dateRapport = null;

    #[ORM\ManyToOne(targetEntity: Agent::class)]
    #[ORM\JoinColumn(name: 'matricule', referencedColumnName: 'matricule', nullable: false)]
    private ?Agent $agent = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nomClient = null;

    #[ORM\ManyToOne(targetEntity: Adresse::class)]
    #[ORM\JoinColumn(name: 'adresse_client_id', referencedColumnName: 'id')]
    private ?Adresse $adresseClient = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentaireInterne = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $materielCommander = null;

    #[ORM\Column(length: 255, options: ['default' => 'Pas_commence'])]
    private ?string $etat = 'Pas_commence';

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $dateFin = null;

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

    public function getDateRapport(): ?\DateTimeInterface
    {
        return $this->dateRapport;
    }

    public function setDateRapport(\DateTimeInterface $dateRapport): static
    {
        $this->dateRapport = $dateRapport;

        return $this;
    }

    public function getAgent(): ?Agent
    {
        return $this->agent;
    }

    public function setAgent(?Agent $agent): static
    {
        $this->agent = $agent;

        return $this;
    }

    public function getNomClient(): ?string
    {
        return $this->nomClient;
    }

    public function setNomClient(?string $nomClient): static
    {
        $this->nomClient = $nomClient;

        return $this;
    }

    public function getAdresseClient(): ?Adresse
    {
        return $this->adresseClient;
    }

    public function setAdresseClient(?Adresse $adresseClient): static
    {
        $this->adresseClient = $adresseClient;

        return $this;
    }

    public function getCommentaireInterne(): ?string
    {
        return $this->commentaireInterne;
    }

    public function setCommentaireInterne(?string $commentaireInterne): static
    {
        $this->commentaireInterne = $commentaireInterne;

        return $this;
    }

    public function getMaterielCommander(): ?string
    {
        return $this->materielCommander;
    }

    public function setMaterielCommander(?string $materielCommander): static
    {
        $this->materielCommander = $materielCommander;

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
