<?php

namespace App\Entity;

use App\Repository\AgentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgentRepository::class)]
class Agent
{
    #[ORM\Id]
    #[ORM\Column(length: 20)]
    private ?string $matricule = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private ?bool $admin = false;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $tel = null;

    #[ORM\Column(type: 'boolean', options: ['default' => true])]
    private ?bool $actif = true;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateEntree = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentaire = null;

    #[ORM\ManyToOne(targetEntity: Agence::class)]
    #[ORM\JoinColumn(name: 'agence_id', referencedColumnName: 'id', nullable: false)]
    private ?Agence $agence = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\OneToOne(inversedBy: 'agent', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'agent', targetEntity: Passeport::class, orphanRemoval: true)]
    private Collection $passeports;

    #[ORM\OneToMany(mappedBy: 'agent', targetEntity: Formation::class, orphanRemoval: true)]
    private Collection $formations;

    #[ORM\OneToMany(mappedBy: 'agent', targetEntity: AgentFonction::class, orphanRemoval: true)]
    private Collection $agentFonctions;

    public function __construct()
    {
        $this->agentFonctions = new ArrayCollection();
        $this->passeports = new ArrayCollection();
        $this->formations = new ArrayCollection();
    }

    /**
     * @return Collection<int, Passeport>
     */
    public function getPasseports(): Collection
    {
        return $this->passeports;
    }

    public function addPasseport(Passeport $passeport): static
    {
        if (!$this->passeports->contains($passeport)) {
            $this->passeports->add($passeport);
            $passeport->setAgent($this);
        }

        return $this;
    }

    public function removePasseport(Passeport $passeport): static
    {
        if ($this->passeports->removeElement($passeport)) {
            // set the owning side to null (unless already changed)
            if ($passeport->getAgent() === $this) {
                $passeport->setAgent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Formation>
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formation $formation): static
    {
        if (!$this->formations->contains($formation)) {
            $this->formations->add($formation);
            $formation->setAgent($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): static
    {
        if ($this->formations->removeElement($formation)) {
            // set the owning side to null (unless already changed)
            if ($formation->getAgent() === $this) {
                $formation->setAgent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AgentFonction>
     */
    public function getAgentFonctions(): Collection
    {
        return $this->agentFonctions;
    }

    public function addAgentFonction(AgentFonction $agentFonction): static
    {
        if (!$this->agentFonctions->contains($agentFonction)) {
            $this->agentFonctions->add($agentFonction);
            $agentFonction->setAgent($this);
        }

        return $this;
    }

    public function removeAgentFonction(AgentFonction $agentFonction): static
    {
        if ($this->agentFonctions->removeElement($agentFonction)) {
            // set the owning side to null (unless already changed)
            if ($agentFonction->getAgent() === $this) {
                $agentFonction->setAgent(null);
            }
        }

        return $this;
    }


    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): static
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function isAdmin(): ?bool
    {
        return $this->admin;
    }

    public function setAdmin(bool $admin): static
    {
        $this->admin = $admin;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    public function isActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): static
    {
        $this->actif = $actif;

        return $this;
    }

    public function getDateEntree(): ?\DateTimeInterface
    {
        return $this->dateEntree;
    }

    public function setDateEntree(?\DateTimeInterface $dateEntree): static
    {
        $this->dateEntree = $dateEntree;

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

    public function getAgence(): ?Agence
    {
        return $this->agence;
    }

    public function setAgence(?Agence $agence): static
    {
        $this->agence = $agence;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}