<?php

namespace App\Entity;

use App\Repository\ConstanceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConstanceRepository::class)
 */
class Constante
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Infirmier::class, inversedBy="constance")
     * @ORM\JoinColumn(nullable=false)
     */
    private $infirmier;

    /**
     * @ORM\ManyToOne(targetEntity=Patient::class, inversedBy="constances")
     * @ORM\JoinColumn(nullable=false)
     */
    private $patient;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $tension;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $pression;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $pouls;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $temperature;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInfirmier(): ?Infirmier
    {
        return $this->infirmier;
    }

    public function setInfirmier(?Infirmier $infirmier): self
    {
        $this->infirmier = $infirmier;

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

    public function getTension(): ?string
    {
        return $this->tension;
    }

    public function setTension(string $tension): self
    {
        $this->tension = $tension;

        return $this;
    }

    public function getPression(): ?string
    {
        return $this->pression;
    }

    public function setPression(string $pression): self
    {
        $this->pression = $pression;

        return $this;
    }

    public function getPouls(): ?string
    {
        return $this->pouls;
    }

    public function setPouls(?string $pouls): self
    {
        $this->pouls = $pouls;

        return $this;
    }

    public function getTemperature(): ?string
    {
        return $this->temperature;
    }

    public function setTemperature(string $temperature): self
    {
        $this->temperature = $temperature;

        return $this;
    }
}
