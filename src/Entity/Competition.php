<?php

namespace App\Entity;

use App\Repository\CompetitionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CompetitionRepository::class)]
class Competition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank(message:"la Date est obligatoire ")]
    #[ORM\Column(length: 255)]
    private ?string $Date = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Arena $arena = null;

    #[Assert\NotBlank(message:"les equipes sont obligatoires ")]
    #[ORM\ManyToMany(targetEntity: Equipe::class, inversedBy: 'competitions')]
    private Collection $equipes;

    #[ORM\Column(length: 255)]
    private ?string $etat = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Equipe $winner = null;
    
    #[Assert\NotBlank(message:"la Date est obligatoire ")]
    #[ORM\Column(length: 255)]
    private ?string $Nom = null;


    
    #[ORM\OneToMany(targetEntity: PerformanceC::class, mappedBy: 'competitionP', cascade: [ 'remove'])]
    private Collection $performanceCs;

    

    public function __construct()
    {
        $this->equipes = new ArrayCollection();
        $this->performanceCs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?string
    {
        return $this->Date;
    }

    public function setDate(string $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getArena(): ?Arena
    {
        return $this->arena;
    }

    public function setArena(?Arena $arena): self
    {
        $this->arena = $arena;

        return $this;
    }

    /**
     * @return Collection<int, Equipe>
     */
    public function getEquipes(): Collection
    {
        return $this->equipes;
    }

    public function addEquipe(Equipe $equipe): self
    {
        if (!$this->equipes->contains($equipe)) {
            $this->equipes->add($equipe);
        }

        return $this;
    }

    public function removeEquipe(Equipe $equipe): self
    {
        $this->equipes->removeElement($equipe);

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getWinner(): ?Equipe
    {
        return $this->winner;
    }

    public function setWinner(?Equipe $winner): self
    {
        $this->winner = $winner;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    /**
     * @return Collection<int, PerformanceC>
     */
    public function getPerformanceCs(): Collection
    {
        return $this->performanceCs;
    }

    public function addPerformanceC(PerformanceC $performanceC): self
    {
        if (!$this->performanceCs->contains($performanceC)) {
            $this->performanceCs->add($performanceC);
            $performanceC->setCompetitionP($this);
        }

        return $this;
    }

    public function removePerformanceC(PerformanceC $performanceC): self
    {
        if ($this->performanceCs->removeElement($performanceC)) {
            // set the owning side to null (unless already changed)
            if ($performanceC->getCompetitionP() === $this) {
                $performanceC->setCompetitionP(null);
            }
        }

        return $this;
    }
    


}
