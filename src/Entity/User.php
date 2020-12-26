<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cni;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateNaiss;

    /**
     * @ORM\Column(type="string", length=14)
     */
    private $telephone;

    /**
     * @ORM\OneToOne(targetEntity=Docteur::class, mappedBy="user", cascade={"persist", "remove"})
     */
    private $docteur;

    /**
     * @ORM\OneToOne(targetEntity=Patient::class, mappedBy="user", cascade={"persist", "remove"})
     */
    private $patient;

    /**
     * @ORM\OneToOne(targetEntity=Caissier::class, mappedBy="user", cascade={"persist", "remove"})
     */
    private $caissier;

    /**
     * @ORM\OneToOne(targetEntity=Infirmier::class, mappedBy="user", cascade={"persist", "remove"})
     */
    private $infirmier;

    /**
     * @ORM\ManyToOne(targetEntity=Profil::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $profil;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pseudo;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = $this->getProfil()->getLibelle();

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCni(): ?string
    {
        return $this->cni;
    }

    public function setCni(string $cni): self
    {
        $this->cni = $cni;

        return $this;
    }

    public function getDateNaiss(): ?\DateTimeInterface
    {
        return $this->dateNaiss;
    }

    public function setDateNaiss(\DateTimeInterface $dateNaiss): self
    {
        $this->dateNaiss = $dateNaiss;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getDocteur(): ?Docteur
    {
        return $this->docteur;
    }

    public function setDocteur(Docteur $docteur): self
    {
        $this->docteur = $docteur;

        // set the owning side of the relation if necessary
        if ($docteur->getUser() !== $this) {
            $docteur->setUser($this);
        }

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(Patient $patient): self
    {
        $this->patient = $patient;

        // set the owning side of the relation if necessary
        if ($patient->getUser() !== $this) {
            $patient->setUser($this);
        }

        return $this;
    }

    public function getCaissier(): ?Caissier
    {
        return $this->caissier;
    }

    public function setCaissier(Caissier $caissier): self
    {
        $this->caissier = $caissier;

        // set the owning side of the relation if necessary
        if ($caissier->getUser() !== $this) {
            $caissier->setUser($this);
        }

        return $this;
    }

    public function getInfirmier(): ?Infirmier
    {
        return $this->infirmier;
    }

    public function setInfirmier(Infirmier $infirmier): self
    {
        $this->infirmier = $infirmier;

        // set the owning side of the relation if necessary
        if ($infirmier->getUser() !== $this) {
            $infirmier->setUser($this);
        }

        return $this;
    }

    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(?Profil $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(?string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

}
