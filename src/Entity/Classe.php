<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClasseRepository::class)]
class Classe {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50, unique: true)]
    private $nomClasse;

    #[ORM\Column(type: 'string', length: 20)]
    private $niveau;

    #[ORM\Column(type: 'string', length: 100)]
    private $filiere;

    #[ORM\OneToMany(mappedBy: 'classe', targetEntity: Inscription::class)]
    private $inscriptions;

    #[ORM\ManyToMany(targetEntity: Professeur::class, inversedBy: 'classes')]
    private $professeurs;

    public function __construct() {
        $this->professeurs = new ArrayCollection();
        $this->inscriptions = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getNomClasse(): ?string {
        return $this->nomClasse;
    }

    public function setNomClasse(string $nomClasse): self {
        $this->nomClasse = $nomClasse;

        return $this;
    }

    public function getNiveau(): ?string {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): self {
        $this->niveau = $niveau;

        return $this;
    }

    public function getFiliere(): ?string {
        return $this->filiere;
    }

    public function setFiliere(string $filiere): self {
        $this->filiere = $filiere;

        return $this;
    }

    /**
     * @return Collection<int, Inscription>
     */
    public function getInscriptions(): Collection {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): self {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions[] = $inscription;
            $inscription->setClasse($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): self {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getClasse() === $this) {
                $inscription->setClasse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Professeur>
     */
    public function getProfesseurs(): Collection {
        return $this->professeurs;
    }

    public function addProfesseur(Professeur $professeur): self {
        if (!$this->professeurs->contains($professeur)) {
            $this->professeurs[] = $professeur;
        }

        return $this;
    }

    public function removeProfesseur(Professeur $professeur): self {
        $this->professeurs->removeElement($professeur);

        return $this;
    }
}
