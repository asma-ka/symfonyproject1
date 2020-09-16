<?php

namespace App\Entity;

use App\Repository\LigneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LigneRepository::class)
 */
class Ligne
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numerLigne;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $planTarifaire;

    /**
     * @ORM\Column(type="integer")
     */
    private $dureeEngagement;

    /**
     * @ORM\OneToMany(targetEntity=Rdv::class, mappedBy="rdvLigne")
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
    public function __toString()
    {
        return $this->planTarifaire;
    }
    public function getNumerLigne(): ?int
    {
        return $this->numerLigne;
    }

    public function setNumerLigne(int $numerLigne): self
    {
        $this->numerLigne = $numerLigne;

        return $this;
    }

    public function getPlanTarifaire(): ?string
    {
        return $this->planTarifaire;
    }

    public function setPlanTarifaire(string $planTarifaire): self
    {
        $this->planTarifaire = $planTarifaire;

        return $this;
    }

    public function getDureeEngagement(): ?int
    {
        return $this->dureeEngagement;
    }

    public function setDureeEngagement(int $dureeEngagement): self
    {
        $this->dureeEngagement = $dureeEngagement;

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
            $rdv->setRdvLigne($this);
        }

        return $this;
    }

    public function removeRdv(Rdv $rdv): self
    {
        if ($this->rdvs->contains($rdv)) {
            $this->rdvs->removeElement($rdv);
            // set the owning side to null (unless already changed)
            if ($rdv->getRdvLigne() === $this) {
                $rdv->setRdvLigne(null);
            }
        }

        return $this;
    }
}
