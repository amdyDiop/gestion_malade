<?php

namespace App\Entity;

use App\Repository\SpecialiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SpecialiteRepository::class)
 */
class Specialite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=Docteur::class, mappedBy="specialite")
     */
    private $docteur;

    public function __construct()
    {
        $this->docteur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Docteur[]
     */
    public function getDocteur(): Collection
    {
        return $this->docteur;
    }

    public function addDocteur(Docteur $docteur): self
    {
        if (!$this->docteur->contains($docteur)) {
            $this->docteur[] = $docteur;
            $docteur->setSpecialite($this);
        }

        return $this;
    }

    public function removeDocteur(Docteur $docteur): self
    {
        if ($this->docteur->removeElement($docteur)) {
            // set the owning side to null (unless already changed)
            if ($docteur->getSpecialite() === $this) {
                $docteur->setSpecialite(null);
            }
        }

        return $this;
    }
}
