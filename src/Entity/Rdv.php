<?php

namespace App\Entity;
use DateTimeImmutable;
use App\DBAL\Types\RdvStatuType;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RdvRepository;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;

/**
 * @ORM\Entity(repositoryClass=RdvRepository::class)
 */
class Rdv
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * 
     * @ORM\Column(type="integer")
     */
    private $numeroRdv;

    

    /**
     * @ORM\Column(type="text")
     */
    private $commentaire;

    /**
     * @ORM\Column(type="float",nullable=true)
     */
    private $prix;

   

    /**
     * @ORM\Column(type="datetime_immutable", length=255)
     */
    private $dateCreation;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="rdvs")
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity=Ligne::class, inversedBy="rdvs")
     */
    private $rdvLigne;

    /**
     * @ORM\ManyToOne(targetEntity=Equipement::class, inversedBy="rdvs")
     */
    private $rdvEqipment;

    /**
     * @ORM\ManyToOne(targetEntity=Prestation::class, inversedBy="rdvs")

     */
    private $rdvPrestation;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="rdvs")
     */
    private $customer;

    /**
     * @ORM\Column(name="rdv_status", type="string", length=255)
     * @DoctrineAssert\Enum(entity="\App\DBAL\Types\RdvStatuType")
     */
    private $rdvStatus;

    /**
     * @ORM\ManyToOne(targetEntity=Motif::class, inversedBy="rdvs")
     */
    private $rdvMotif;

    /**
     * @ORM\ManyToOne(targetEntity=Zone::class, inversedBy="rdvs")
     */
    private $rdvZone;

    /**
     * @ORM\ManyToOne(targetEntity=Prestataire::class, inversedBy="rdvs")
     */
    private $prestataire;

   
  public function __construct(){
      $this->dateCreation=new \DateTimeImmutable();

  }
  

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroRdv(): ?int
    {
        return $this->numeroRdv;
    }

    public function setNumeroRdv(int $numeroRdv): self
    {
        $this->numeroRdv = $numeroRdv;

        return $this;
    }

    

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }
    
    public function getDateCreation():? \DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getRdvLigne(): ?Ligne
    {
        return $this->rdvLigne;
    }

    public function setRdvLigne(?Ligne $rdvLigne): self
    {
        $this->rdvLigne = $rdvLigne;

        return $this;
    }

    public function getRdvEqipment(): ?Equipement
    {
        return $this->rdvEqipment;
    }

    public function setRdvEqipment(?Equipement $rdvEqipment): self
    {
        $this->rdvEqipment = $rdvEqipment;

        return $this;
    }

    public function getRdvPrestation(): ?Prestation
    {
        return $this->rdvPrestation;
    }

    public function setRdvPrestation(?Prestation $rdvPrestation): self
    {
        $this->rdvPrestation = $rdvPrestation;

        return $this;
    }

    public function getCustomer(): ?Client
    {
        return $this->customer;
    }

    public function setCustomer(?Client $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getRdvStatus(): ?string
    {
        return $this->rdvStatus;
    }

    public function setRdvStatus(?string $rdvStatus): self
    {
        $this->rdvStatus = $rdvStatus;

        return $this;
    }

    public function getRdvMotif(): ?Motif
    {
        return $this->rdvMotif;
    }

    public function setRdvMotif(?Motif $rdvMotif): self
    {
        $this->rdvMotif = $rdvMotif;

        return $this;
    }

    public function getRdvZone(): ?Zone
    {
        return $this->rdvZone;
    }

    public function setRdvZone(?Zone $rdvZone): self
    {
        $this->rdvZone = $rdvZone;

        return $this;
    }

    public function getPrestataire(): ?Prestataire
    {
        return $this->prestataire;
    }

    public function setPrestataire(?Prestataire $prestataire): self
    {
        $this->prestataire = $prestataire;

        return $this;
    }

    
}
