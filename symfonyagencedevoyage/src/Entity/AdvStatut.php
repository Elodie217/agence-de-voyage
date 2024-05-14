<?php

namespace App\Entity;

use App\Repository\AdvStatutRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: AdvStatutRepository::class)]
#[ORM\UniqueConstraint(fields: ['statut'])]
#[UniqueEntity(fields: ['statut'], message: 'Ce statut existe déjà.')]
class AdvStatut
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    /**
     * @var Collection<int, AdvReservation>
     */
    #[ORM\OneToMany(targetEntity: AdvReservation::class, mappedBy: 'statut')]
    private Collection $advReservations;

    public function __construct()
    {
        $this->advReservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection<int, AdvReservation>
     */
    public function getAdvReservations(): Collection
    {
        return $this->advReservations;
    }

    public function addAdvReservation(AdvReservation $advReservation): static
    {
        if (!$this->advReservations->contains($advReservation)) {
            $this->advReservations->add($advReservation);
            $advReservation->setStatut($this);
        }

        return $this;
    }

    public function removeAdvReservation(AdvReservation $advReservation): static
    {
        if ($this->advReservations->removeElement($advReservation)) {
            // set the owning side to null (unless already changed)
            if ($advReservation->getStatut() === $this) {
                $advReservation->setStatut(null);
            }
        }

        return $this;
    }
}
