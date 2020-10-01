<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="text")
     */
    private $cordonees;

    /**
     * @ORM\OneToMany(targetEntity=Rdv::class, mappedBy="customer")
     */
    private $rdvs;

  

    public function __construct()
    {
        $this->rdvs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
     /**
     * Get Nom
     *
     * @return string
     */

    public function getNom(): ?string
    {
        return $this->nom;
    }
    /**
     * Set Nom
     *
     * @param string $nom
     *
     * @return Client
     */
    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }
    public function __toString()
    {
        return $this->nom;
        
    }
    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Client
     */

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }
    /**
     * Get typeIdentification
     *
     * @return string
     */

    public function getTypeIdentification(): ?string
    {
        return $this->typeIdentification;
    }
    /**
     * Set typeIdentification
     *
     * @param string $typeIdentification
     *
     * @return Client
     */

    public function setTypeIdentification(string $typeIdentification): self
    {
        $this->typeIdentification = $typeIdentification;

        return $this;
    }
    /**
     * Get numIdentification
     *
     * @return int
     */

    public function getNumeroIdentification(): ?int
    {
        return $this->numeroIdentification;
    }
    /**
     * Set numIdentification
     *
     * @param int $numeroIdentification
     *
     * @return Client
     */

    public function setNumeroIdentification( $numeroIdentification)
    {
        $this->numeroIdentification = $numeroIdentification;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }
    /**
     * Set adress
     *
     * @param string $adress
     *
     * @return Client
     */

    public function setAdress( $adress)
    {
        $this->adress = $adress;

        return $this;
    }

    public function getNumeroContrat(): ?int
    {
        return $this->NumeroContrat;
    }
    /**
     * Set NumeroContrat
     *
     * @param int $NumeroContrat
     *
     * @return Client
     */

    public function setNumeroContrat( $NumeroContrat)
    {
        $this->NumeroContrat = $NumeroContrat;

        return $this;
    }
/**
     * Get cordonnees
     *
     * @param string $cordonees
     *
     * @return Client
     */
   

    public function getCordonees(): ?string
    {
        return $this->cordonees;
    }
/**
     * Set cordonnees
     *
     * @param string $cordonees
     *
     * @return Client
     */
    public function setCordonees( $cordonees)
    {
        $this->cordonees = $cordonees;

        return $this;
    }

    /**
     * @return Collection|Rdv[]
     */
    public function getRdvs(): Collection
    {
        return $this->rdvs;
    }

    public function addRdv(Rdv $rdv): self
    {
        if (!$this->rdvs->contains($rdv)) {
            $this->rdvs[] = $rdv;
            $rdv->setCustomer($this);
        }

        return $this;
    }

    public function removeRdv(Rdv $rdv): self
    {
        if ($this->rdvs->contains($rdv)) {
            $this->rdvs->removeElement($rdv);
            // set the owning side to null (unless already changed)
            if ($rdv->getCustomer() === $this) {
                $rdv->setCustomer(null);
            }
        }

        return $this;
    }



}
