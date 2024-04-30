<?php

namespace App\Entity;

use App\Repository\AdvPaysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdvPaysRepository::class)]
class AdvPays
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_pays = null;

    /**
     * @var Collection<int, AdvVoyage>
     */
    #[ORM\ManyToMany(targetEntity: AdvVoyage::class, mappedBy: 'pays')]
    private Collection $advVoyages;

    public function __construct()
    {
        $this->advVoyages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPays(): ?string
    {
        return $this->nom_pays;
    }

    public function setNomPays(string $nom_pays): static
    {
        $this->nom_pays = $nom_pays;

        return $this;
    }

    /**
     * @return Collection<int, AdvVoyage>
     */
    public function getAdvVoyages(): Collection
    {
        return $this->advVoyages;
    }

    public function addAdvVoyage(AdvVoyage $advVoyage): static
    {
        if (!$this->advVoyages->contains($advVoyage)) {
            $this->advVoyages->add($advVoyage);
            $advVoyage->addPay($this);
        }

        return $this;
    }

    public function removeAdvVoyage(AdvVoyage $advVoyage): static
    {
        if ($this->advVoyages->removeElement($advVoyage)) {
            $advVoyage->removePay($this);
        }

        return $this;
    }
}
