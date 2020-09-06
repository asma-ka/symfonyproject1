<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeIdentification;

    /**
     * @ORM\Column(type="integer")
     */
    private $numeroIdentification;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adress;

    /**
     * @ORM\Column(type="integer")
     */
    private $NumeroContrat;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateprivisionnelle;

    /**
     * @ORM\Column(type="text")
     */
    private $cordonees;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTypeIdentification(): ?string
    {
        return $this->typeIdentification;
    }

    public function setTypeIdentification(string $typeIdentification): self
    {
        $this->typeIdentification = $typeIdentification;

        return $this;
    }

    public function getNumeroIdentification(): ?int
    {
        return $this->numeroIdentification;
    }

    public function setNumeroIdentification(int $numeroIdentification): self
    {
        $this->numeroIdentification = $numeroIdentification;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getNumeroContrat(): ?int
    {
        return $this->NumeroContrat;
    }

    public function setNumeroContrat(int $NumeroContrat): self
    {
        $this->NumeroContrat = $NumeroContrat;

        return $this;
    }

    public function getDateprivisionnelle(): ?\DateTimeInterface
    {
        return $this->dateprivisionnelle;
    }

    public function setDateprivisionnelle(\DateTimeInterface $dateprivisionnelle): self
    {
        $this->dateprivisionnelle = $dateprivisionnelle;

        return $this;
    }

    public function getCordonees(): ?string
    {
        return $this->cordonees;
    }

    public function setCordonees(string $cordonees): self
    {
        $this->cordonees = $cordonees;

        return $this;
    }
}
