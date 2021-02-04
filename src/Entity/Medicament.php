<?php

namespace App\Entity;

use App\Repository\MedicamentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MedicamentRepository::class)
 */
class Medicament
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"medicaments"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"medicaments"})
     */
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity=Ordenance::class, mappedBy="medicaments")
     */
    private $ordenances;

    public function __construct()
    {
        $this->ordenances = new ArrayCollection();
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
     * @return Collection|Ordenance[]
     */
    public function getOrdenances(): Collection
    {
        return $this->ordenances;
    }

    public function addOrdenance(Ordenance $ordenance): self
    {
        if (!$this->ordenances->contains($ordenance)) {
            $this->ordenances[] = $ordenance;
            $ordenance->addMedicament($this);
        }

        return $this;
    }

    public function removeOrdenance(Ordenance $ordenance): self
    {
        if ($this->ordenances->removeElement($ordenance)) {
            $ordenance->removeMedicament($this);
        }

        return $this;
    }
}
