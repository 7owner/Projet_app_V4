<?php

namespace App\Entity;

use App\Repository\ImagesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImagesRepository::class)]
class Images
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomFichier = null;

    #[ORM\Column(length: 100, options: ['default' => 'image/jpeg'])]
    private ?string $typeMime = 'image/jpeg';

    #[ORM\Column(type: Types::BIGINT)]
    private ?int $tailleOctets = null;

    #[ORM\Column(type: Types::BLOB)]
    private $imageBlob = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentaireImage = null;

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

    public function setTailleOctets(int $tailleOctets): static
    {
        $this->tailleOctets = $tailleOctets;

        return $this;
    }

    public function getImageBlob()
    {
        return $this->imageBlob;
    }

    public function setImageBlob($imageBlob): static
    {
        $this->imageBlob = $imageBlob;

        return $this;
    }

    public function getCommentaireImage(): ?string
    {
        return $this->commentaireImage;
    }

    public function setCommentaireImage(?string $commentaireImage): static
    {
        $this->commentaireImage = $commentaireImage;

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
