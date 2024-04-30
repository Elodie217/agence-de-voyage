<?php

namespace App\Entity;

use App\Repository\AdvStatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdvStatusRepository::class)]
class AdvStatus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $status_status = null;

    /**
     * @var Collection<int, AdvReservation>
     */
    #[ORM\OneToMany(targetEntity: AdvReservation::class, mappedBy: 'status')]
    private Collection $advReservations;

    public function __construct()
    {
        $this->advReservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatusStatus(): ?string
    {
        return $this->status_status;
    }

    public function setStatusStatus(string $status_status): static
    {
        $this->status_status = $status_status;

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
            $advReservation->setStatus($this);
        }

        return $this;
    }

    public function removeAdvReservation(AdvReservation $advReservation): static
    {
        if ($this->advReservations->removeElement($advReservation)) {
            // set the owning side to null (unless already changed)
            if ($advReservation->getStatus() === $this) {
                $advReservation->setStatus(null);
            }
        }

        return $this;
    }
}
