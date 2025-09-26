<?php

namespace App\Entity;

use App\Repository\RenduInterventionImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RenduInterventionImageRepository::class)]
#[ORM\Table(name: 'rendu_intervention_image')]
#[ORM\UniqueConstraint(name: 'rendu_intervention_image_unique', columns: ['rendu_intervention_id', 'image_id'])]
class RenduInterventionImage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: RenduIntervention::class)]
    #[ORM\JoinColumn(name: 'rendu_intervention_id', referencedColumnName: 'id', nullable: false)]
    private ?RenduIntervention $renduIntervention = null;

    #[ORM\ManyToOne(targetEntity: Images::class)]
    #[ORM\JoinColumn(name: 'image_id', referencedColumnName: 'id', nullable: false)]
    private ?Images $image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRenduIntervention(): ?RenduIntervention
    {
        return $this->renduIntervention;
    }

    public function setRenduIntervention(?RenduIntervention $renduIntervention): static
    {
        $this->renduIntervention = $renduIntervention;

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
