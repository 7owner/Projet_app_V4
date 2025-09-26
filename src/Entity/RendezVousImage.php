<?php

namespace App\Entity;

use App\Repository\RendezVousImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RendezVousImageRepository::class)]
#[ORM\Table(name: 'rendez_vous_image')]
#[ORM\UniqueConstraint(name: 'rendez_vous_image_unique', columns: ['rendez_vous_id', 'image_id'])]
class RendezVousImage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: RendezVous::class)]
    #[ORM\JoinColumn(name: 'rendez_vous_id', referencedColumnName: 'id', nullable: false)]
    private ?RendezVous $rendezVous = null;

    #[ORM\ManyToOne(targetEntity: Images::class)]
    #[ORM\JoinColumn(name: 'image_id', referencedColumnName: 'id', nullable: false)]
    private ?Images $image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRendezVous(): ?RendezVous
    {
        return $this->rendezVous;
    }

    public function setRendezVous(?RendezVous $rendezVous): static
    {
        $this->rendezVous = $rendezVous;

        return $this;
    }

    public function getImage(): ?Images
    {
        return $this->image;
    }

    public function setImage(?Images $image): static
    {
        $this->image = $image;

        return $this;
    }
}
