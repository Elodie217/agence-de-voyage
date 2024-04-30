<?php

namespace App\Entity;

use App\Repository\AdvReservationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdvReservationRepository::class)]
class AdvReservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $message_reservation = null;

    #[ORM\ManyToOne(inversedBy: 'reservation')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AdvVoyage $advVoyage = null;

    #[ORM\ManyToOne(inversedBy: 'advReservations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AdvStatus $status = null;

    #[ORM\ManyToOne(inversedBy: 'advReservations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AdvUtilisateur $utilisateur = null;

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

    public function getStatus(): ?AdvStatus
    {
        return $this->status;
    }

    public function setStatus(?AdvStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getUtilisateur(): ?AdvUtilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?AdvUtilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
}
