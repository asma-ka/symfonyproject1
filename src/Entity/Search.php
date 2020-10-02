<?php
namespace App\Entity;
class Search 
{
    /**
     * @var string|null
     */

    private $prestataire;
    /**
     * @var string|null
     */
    private $dateCreation;
    /**
     * @var int|null
     */
    private $numeroRdv;


    public function getNumeroRdv(): ?int
    {
        return $this->numeroRdv;
    }

    public function setNumeroRdv(int $numeroRdv): self
    {
        $this->numeroRdv = $numeroRdv;

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
    public function getPrestataire(): ?string
    {
        return $this->prestataire;
    }

    public function setPrestataire(string $prestataire): self
    {
        $this->prestataire = $prestataire;

        return $this;
    }

}
