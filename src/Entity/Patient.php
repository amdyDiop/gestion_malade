<?php

namespace App\Entity;

use App\Repository\PatientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PatientRepository::class)
 */
class Patient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="patient", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups ({"patient"})
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Visite::class, mappedBy="patient")
     */
    private $visites;

    /**
     * @ORM\OneToMany(targetEntity=Ticket::class, mappedBy="patient")
     */
    private $tickets;

    /**
     * @ORM\OneToMany(targetEntity=Constante::class, mappedBy="patient")
     */
    private $constances;

    public function __construct()
    {
        $this->visites = new ArrayCollection();
        $this->tickets = new ArrayCollection();
        $this->constances = new ArrayCollection();
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
     * @return Collection|Visite[]
     */
    public function getVisites(): Collection
    {
        return $this->visites;
    }

    public function addVisite(Visite $visite): self
    {
        if (!$this->visites->contains($visite)) {
            $this->visites[] = $visite;
            $visite->setPatient($this);
        }

        return $this;
    }

    public function removeVisite(Visite $visite): self
    {
        if ($this->visites->removeElement($visite)) {
            // set the owning side to null (unless already changed)
            if ($visite->getPatient() === $this) {
                $visite->setPatient(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection|Ticket[]
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function addTicket(Ticket $ticket): self
    {
        if (!$this->tickets->contains($ticket)) {
            $this->tickets[] = $ticket;
            $ticket->setPatient($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): self
    {
        if ($this->tickets->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getPatient() === $this) {
                $ticket->setPatient(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection|Constante[]
     */
    public function getConstances(): Collection
    {
        return $this->constances;
    }

    public function addConstance(Constante $constance): self
    {
        if (!$this->constances->contains($constance)) {
            $this->constances[] = $constance;
            $constance->setPatient($this);
        }

        return $this;
    }

    public function removeConstance(Constante $constance): self
    {
        if ($this->constances->removeElement($constance)) {
            // set the owning side to null (unless already changed)
            if ($constance->getPatient() === $this) {
                $constance->setPatient(null);
            }
        }

        return $this;
    }

   }
