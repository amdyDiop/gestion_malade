<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TicketRepository::class)
 */
class Ticket
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="le montant est obligatoire")
     */
    private $montant;

    /**
     * @ORM\ManyToOne(targetEntity=Caissier::class, inversedBy="ticket")
     * @ORM\JoinColumn(nullable=false)
     */
    private $caissier;

    /**
     * @ORM\ManyToOne(targetEntity=Patient::class, inversedBy="tickets",cascade="persist")
     * @ORM\JoinColumn(nullable=true)
     */
    private $patient;
    /**
     * @ORM\ManyToOne(targetEntity=TypeVisite::class, inversedBy="ticket",cascade="persist")
     * @Assert\NotNull(message="le type de visite est obligatoire")
     * @ORM\JoinColumn(nullable=false)
     */

    private $typeVisite;


    function __construct()
    {
        $this->createdAt = new \DateTime();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getCaissier(): ?Caissier
    {
        return $this->caissier;
    }

    public function setCaissier(?Caissier $caissier): self
    {
        $this->caissier = $caissier;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }

    public function getTypeVisite(): ?TypeVisite
    {
        return $this->typeVisite;
    }

    public function setTypeVisite(?TypeVisite $typeVisite): self
    {
        $this->typeVisite = $typeVisite;

        return $this;
    }
}
