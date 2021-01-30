<?php

namespace App\Entity;

use App\Repository\ConstanceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ConstanceRepository::class)
 */
class Constante
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups ({"constante"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Infirmier::class, inversedBy="constance")
     * @ORM\JoinColumn(nullable=false)
     * @Groups ({"constante"})
     */
    private $infirmier;

    /**
     * @ORM\ManyToOne(targetEntity=Patient::class, inversedBy="constances")
     * @ORM\JoinColumn(nullable=false)
     * @Groups ({"constante"})
     */
    private $patient;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups ({"constante"})
     */
    private $tenssion;

    /**
     * @ORM\Column(type="string", length=15)
     * @Groups ({"constante"})
     */
    private $pression;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Groups ({"constante"})
     */
    private $pouls;

    /**
     * @ORM\Column(type="string", length=5)
     * @Groups ({"constante"})
     */
    private $temperature;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt ;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

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

    public function getTenssion(): ?string
    {
        return $this->tenssion;
    }

    public function setTenssion(string $tenssion): self
    {
        $this->tenssion = $tenssion;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
