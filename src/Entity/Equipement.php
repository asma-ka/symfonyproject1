<?php

namespace App\Entity;

use App\Repository\EquipementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EquipementRepository::class)
 */
class Equipement
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
    private $adressMac;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numeroSerie;

    /**
     * @ORM\Column(type="integer")
     */
    private $garentie;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateDbGartie;

    /**
     * @ORM\OneToMany(targetEntity=Rdv::class, mappedBy="rdvEqipment")
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

    public function getAdressMac(): ?string
    {
        return $this->adressMac;
    }

    public function setAdressMac(string $adressMac): self
    {
        $this->adressMac = $adressMac;

        return $this;
    }

    public function getNumeroSerie(): ?string
    {
        return $this->numeroSerie;
    }

    public function setNumeroSerie(string $numeroSerie): self
    {
        $this->numeroSerie = $numeroSerie;

        return $this;
    }

    public function getGarentie(): ?int
    {
        return $this->garentie;
    }

    public function setGarentie(int $garentie): self
    {
        $this->garentie = $garentie;

        return $this;
    }

    public function getDateDbGartie(): ?\DateTimeInterface
    {
        return $this->DateDbGartie;
    }

    public function setDateDbGartie(\DateTimeInterface $DateDbGartie): self
    {
        $this->DateDbGartie = $DateDbGartie;

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
            $rdv->setRdvEqipment($this);
        }

        return $this;
    }

    public function removeRdv(Rdv $rdv): self
    {
        if ($this->rdvs->contains($rdv)) {
            $this->rdvs->removeElement($rdv);
            // set the owning side to null (unless already changed)
            if ($rdv->getRdvEqipment() === $this) {
                $rdv->setRdvEqipment(null);
            }
        }

        return $this;
    }
}
