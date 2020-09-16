<?php

namespace App\Entity;

use App\Repository\PrestationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrestationRepository::class)
 */
class Prestation
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
    private $numeroPrestation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $genre;

    /**
     * @ORM\ManyToOne(targetEntity=DugreUrgence::class, inversedBy="prestations")
     */
    private $pstionDrUrgc;

    /**
     * @ORM\ManyToOne(targetEntity=Prestataire::class, inversedBy="prestations")
     */
    private $prstionPrstaire;

    /**
     * @ORM\OneToMany(targetEntity=Rdv::class, mappedBy="rdvPrestation")
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

    public function getNumeroPrestation(): ?int
    {
        return $this->numeroPrestation;
    }

    public function setNumeroPrestation(int $numeroPrestation): self
    {
        $this->numeroPrestation = $numeroPrestation;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }
    public function __toString()
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getPstionDrUrgc(): ?DugreUrgence
    {
        return $this->pstionDrUrgc;
    }

    public function setPstionDrUrgc(?DugreUrgence $pstionDrUrgc): self
    {
        $this->pstionDrUrgc = $pstionDrUrgc;

        return $this;
    }

    public function getPrstionPrstaire(): ?Prestataire
    {
        return $this->prstionPrstaire;
    }

    public function setPrstionPrstaire(?Prestataire $prstionPrstaire): self
    {
        $this->prstionPrstaire = $prstionPrstaire;

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
            $rdv->setRdvPrestation($this);
        }

        return $this;
    }

    public function removeRdv(Rdv $rdv): self
    {
        if ($this->rdvs->contains($rdv)) {
            $this->rdvs->removeElement($rdv);
            // set the owning side to null (unless already changed)
            if ($rdv->getRdvPrestation() === $this) {
                $rdv->setRdvPrestation(null);
            }
        }

        return $this;
    }
}
