<?php

namespace App\Entity;

use App\Repository\VisiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VisiteRepository::class)
 */
class Visite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dateVisite;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $rv;

    /**
     * @ORM\ManyToOne(targetEntity=Patient::class, inversedBy="visites")
     */
    private $patient;

    /**
     * @ORM\ManyToOne(targetEntity=Docteur::class, inversedBy="visites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $docteur;

    /**
     * @ORM\Column(type="text")
     */
    private $note;



    /**
     * @ORM\OneToOne(targetEntity=Ordenance::class, cascade={"persist", "remove"})
     */
    private $ordenance;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateVisite(): ?string
    {
        return $this->dateVisite;
    }

    public function setDateVisite(string $dateVisite): self
    {
        $this->dateVisite = $dateVisite;

        return $this;
    }

    public function getRv(): ?\DateTimeInterface
    {
        return $this->rv;
    }

    public function setRv(?\DateTimeInterface $rv): self
    {
        $this->rv = $rv;

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

    public function getDocteur(): ?Docteur
    {
        return $this->docteur;
    }

    public function setDocteur(?Docteur $docteur): self
    {
        $this->docteur = $docteur;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): self
    {
        $this->note = $note;

        return $this;
    }


    public function getOrdenance(): ?Ordenance
    {
        return $this->ordenance;
    }

    public function setOrdenance(?Ordenance $ordenance): self
    {
        $this->ordenance = $ordenance;

        return $this;
    }
}
