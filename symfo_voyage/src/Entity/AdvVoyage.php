<?php

namespace App\Entity;

use App\Repository\AdvVoyageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: AdvVoyageRepository::class)]
class AdvVoyage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "La desctination ne peux pas rester vide.")]
    private ?string $destination_voyage = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "La durée du voyage ne peux pas rester vide.")]
    #[Assert\GreaterThan(
        value: 0,
        message: 'La durée du voyage doit au minimum d\'un jour',
    )]
    private ?int $duree_voyage = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "L'url d'image ne peux pas rester vide.")]
    private ?string $image_voyage = null;

    #[ORM\Column(length: 500, nullable: true)]
    #[Assert\Length(max: 500, maxMessage: "La description ne peut avoir plus de 500 caractères.")]
    private ?string $description_voyage = null;

    /**
     * @var Collection<int, AdvCategorie>
     */
    #[ORM\ManyToMany(targetEntity: AdvCategorie::class, inversedBy: 'advVoyages')]
    #[Assert\NotBlank(message: "Merci de choisir au moins une categorie.")]
    private Collection $categorie;

    /**
     * @var Collection<int, AdvPays>
     */
    #[ORM\ManyToMany(targetEntity: AdvPays::class, inversedBy: 'advVoyages')]
    #[Assert\NotBlank(message: "Merci de choisir au moins un pays.")]
    private Collection $pays;

    /**
     * @var Collection<int, AdvReservation>
     */
    #[ORM\OneToMany(targetEntity: AdvReservation::class, mappedBy: 'advVoyage')]
    private Collection $reservation;

    #[ORM\ManyToOne(inversedBy: 'advVoyages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AdvUtilisateur $utilisateur = null;

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
