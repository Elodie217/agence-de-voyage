<?php

namespace App\Entity;

use App\Repository\AdvVoyageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: AdvVoyageRepository::class)]
class AdvVoyage
{
    #[Groups(['api_voyage_index'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['api_voyage_index'])]
    #[ORM\Column(length: 255)]
    #[Assert\Length(max: 255, maxMessage: "La destination ne peut pas avoir plus de 255 caractères.")]
    #[Assert\NotBlank(message: "La destination ne peux pas rester vide.")]
    private ?string $destination_voyage = null;

    #[Groups(['api_voyage_index'])]
    #[ORM\Column]
    #[Assert\NotBlank(message: "La durée ne peux pas rester vide.")]
    #[Assert\GreaterThan(
        value: 0,
        message: 'La durée du voyage doit au minimum d\'un jour',
    )]
    private ?int $duree_voyage = null;

    #[Groups(['api_voyage_index'])]
    #[ORM\Column(length: 255)]
    #[Assert\Url(
        message: "L'url n'est pas valide",
    )]
    #[Assert\Length(max: 255, maxMessage: "L'URL ne peut pas avoir plus de 255 caractères.")]
    #[Assert\NotBlank(message: "L'URL ne peux pas rester vide.")]
    private ?string $image_voyage = null;

    #[Groups(['api_voyage_index'])]
    #[ORM\Column(length: 255)]
    #[Assert\Url(
        message: "L'url n'est pas valide",
    )]
    #[Assert\Length(max: 255, maxMessage: "L'URL ne peut pas avoir plus de 255 caractères.")]
    #[Assert\NotBlank(message: "L'URL ne peux pas rester vide.")]
    private ?string $imagebis_voyage = null;

    #[Groups(['api_voyage_index'])]
    #[ORM\Column(length: 500, nullable: true)]
    #[Assert\Length(max: 500, maxMessage: "La description ne peut pas avoir plus de 500 caractères.")]
    private ?string $description_voyage = null;

    /**
     * @var Collection<int, AdvCategorie>
     */
    #[Groups(['api_voyage_index'])]
    #[ORM\ManyToMany(targetEntity: AdvCategorie::class, inversedBy: 'advVoyages')]
    private Collection $categorie;

    /**
     * @var Collection<int, AdvPays>
     */
    #[Groups(['api_voyage_index'])]
    #[ORM\ManyToMany(targetEntity: AdvPays::class, inversedBy: 'advVoyages')]
    private Collection $pays;

    #[ORM\ManyToOne(inversedBy: 'advVoyages')]
    private ?User $user = null;

    /**
     * @var Collection<int, AdvReservation>
     */
    #[ORM\OneToMany(targetEntity: AdvReservation::class, mappedBy: 'advVoyage')]
    private Collection $reservation;

    public function __construct()
    {
        $this->categorie = new ArrayCollection();
        $this->pays = new ArrayCollection();
        $this->reservation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDestinationVoyage(): ?string
    {
        return $this->destination_voyage;
    }

    public function setDestinationVoyage(string $destination_voyage): static
    {
        $this->destination_voyage = $destination_voyage;

        return $this;
    }

    public function getDureeVoyage(): ?int
    {
        return $this->duree_voyage;
    }

    public function setDureeVoyage(int $duree_voyage): static
    {
        $this->duree_voyage = $duree_voyage;

        return $this;
    }

    public function getImageVoyage(): ?string
    {
        return $this->image_voyage;
    }

    public function setImageVoyage(string $image_voyage): static
    {
        $this->image_voyage = $image_voyage;

        return $this;
    }

    public function getImagebisVoyage(): ?string
    {
        return $this->imagebis_voyage;
    }

    public function setImagebisVoyage(string $imagebis_voyage): static
    {
        $this->imagebis_voyage = $imagebis_voyage;

        return $this;
    }

    public function getDescriptionVoyage(): ?string
    {
        return $this->description_voyage;
    }

    public function setDescriptionVoyage(?string $description_voyage): static
    {
        $this->description_voyage = $description_voyage;

        return $this;
    }

    /**
     * @return Collection<int, AdvCategorie>
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(AdvCategorie $categorie): static
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie->add($categorie);
        }

        return $this;
    }

    public function removeCategorie(AdvCategorie $categorie): static
    {
        $this->categorie->removeElement($categorie);

        return $this;
    }

    /**
     * @return Collection<int, AdvPays>
     */
    public function getPays(): Collection
    {
        return $this->pays;
    }

    public function addPay(AdvPays $pay): static
    {
        if (!$this->pays->contains($pay)) {
            $this->pays->add($pay);
        }

        return $this;
    }

    public function removePay(AdvPays $pay): static
    {
        $this->pays->removeElement($pay);

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

    /**
     * @return Collection<int, AdvReservation>
     */
    public function getReservation(): Collection
    {
        return $this->reservation;
    }

    public function addReservation(AdvReservation $reservation): static
    {
        if (!$this->reservation->contains($reservation)) {
            $this->reservation->add($reservation);
            $reservation->setAdvVoyage($this);
        }

        return $this;
    }

    public function removeReservation(AdvReservation $reservation): static
    {
        if ($this->reservation->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getAdvVoyage() === $this) {
                $reservation->setAdvVoyage(null);
            }
        }

        return $this;
    }
}
