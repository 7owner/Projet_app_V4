<?php

namespace App\Entity;

use App\Repository\DocumentsRepertoireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocumentsRepertoireRepository::class)]
#[ORM\Table(name: 'documents_repertoire')]
class DocumentsRepertoire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $cibleType = null;

    #[ORM\Column(length: 255)] // Changed to string to accommodate Agent's matricule
    private ?string $cibleId = null;

    #[ORM\Column(length: 255, options: ['default' => 'Document'])]
    private ?string $nature = 'Document';

    #[ORM\Column(length: 255)]
    private ?string $nomFichier = null;

    #[ORM\Column(length: 100, options: ['default' => 'application/octet-stream'])]
    private ?string $typeMime = 'application/octet-stream';

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?int $tailleOctets = null;

    #[ORM\Column(length: 1024, nullable: true)]
    private ?string $cheminFichier = null;

    #[ORM\Column(length: 64, nullable: true)]
    private ?string $checksumSha256 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentaire = null;

    #[ORM\ManyToOne(targetEntity: Agent::class)]
    #[ORM\JoinColumn(name: 'auteur_matricule', referencedColumnName: 'matricule')]
    private ?Agent $auteur = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $dateFin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCibleType(): ?string
    {
        return $this->cibleType;
    }

    public function setCibleType(string $cibleType): static
    {
        $this->cibleType = $cibleType;

        return $this;
    }

    public function getCibleId(): ?string
    {
        return $this->cibleId;
    }

    public function setCibleId(string $cibleId): static
    {
        $this->cibleId = $cibleId;

        return $this;
    }

    public function getNature(): ?string
    {
        return $this->nature;
    }

    public function setNature(string $nature): static
    {
        $this->nature = $nature;

        return $this;
    }

    public function getNomFichier(): ?string
    {
        return $this->nomFichier;
    }

    public function setNomFichier(string $nomFichier): static
    {
        $this->nomFichier = $nomFichier;

        return $this;
    }

    public function getTypeMime(): ?string
    {
        return $this->typeMime;
    }

    public function setTypeMime(string $typeMime): static
    {
        $this->typeMime = $typeMime;

        return $this;
    }

    public function getTailleOctets(): ?int
    {
        return $this->tailleOctets;
    }

    public function setTailleOctets(?int $tailleOctets): static
    {
        $this->tailleOctets = $tailleOctets;

        return $this;
    }

    public function getCheminFichier(): ?string
    {
        return $this->cheminFichier;
    }

    public function setCheminFichier(?string $cheminFichier): static
    {
        $this->cheminFichier = $cheminFichier;

        return $this;
    }

    public function getChecksumSha256(): ?string
    {
        return $this->checksumSha256;
    }

    public function setChecksumSha256(?string $checksumSha256): static
    {
        $this->checksumSha256 = $checksumSha256;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getAuteur(): ?Agent
    {
        return $this->auteur;
    }

    public function setAuteur(?Agent $auteur): static
    {
        $this->auteur = $auteur;

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
