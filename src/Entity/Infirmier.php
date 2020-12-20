<?php

namespace App\Entity;

use App\Repository\InfirmierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InfirmierRepository::class)
 */
class Infirmier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="infirmier", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Constante::class, mappedBy="infirmier")
     */
    private $constance;

    public function __construct()
    {
        $this->constance = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Constante[]
     */
    public function getConstance(): Collection
    {
        return $this->constance;
    }

    public function addConstance(Constante $constance): self
    {
        if (!$this->constance->contains($constance)) {
            $this->constance[] = $constance;
            $constance->setInfirmier($this);
        }

        return $this;
    }

    public function removeConstance(Constante $constance): self
    {
        if ($this->constance->removeElement($constance)) {
            // set the owning side to null (unless already changed)
            if ($constance->getInfirmier() === $this) {
                $constance->setInfirmier(null);
            }
        }

        return $this;
    }
}
