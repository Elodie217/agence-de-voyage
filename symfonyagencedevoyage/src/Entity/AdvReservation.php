<?php

namespace App\Entity;

use App\Repository\AdvReservationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AdvReservationRepository::class)]
class AdvReservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500, nullable: true)]
    #[Groups(['api_reservation_new'])]
    private ?string $message_reservation = null;

    #[ORM\ManyToOne(inversedBy: 'reservation')]
    // #[Groups(['api_reservation_new'])]
    private ?AdvVoyage $advVoyage = null;

    #[ORM\ManyToOne(inversedBy: 'advReservations')]
    #[Groups(['api_reservation_new'])]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'advReservations')]
    private ?AdvStatut $statut = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessageReservation(): ?string
    {
        return $this->message_reservation;
    }

    public function setMessageReservation(?string $message_reservation): static
    {
        $this->message_reservation = $message_reservation;

        return $this;
    }

    public function getAdvVoyage(): ?AdvVoyage
    {
        return $this->advVoyage;
    }

    public function setAdvVoyage(?AdvVoyage $advVoyage): static
    {
        $this->advVoyage = $advVoyage;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getStatut(): ?AdvStatut
    {
        return $this->statut;
    }

    public function setStatut(?AdvStatut $statut): static
    {
        $this->statut = $statut;

        return $this;
    }
}
