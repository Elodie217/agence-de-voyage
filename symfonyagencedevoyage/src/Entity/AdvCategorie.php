<?php

namespace App\Entity;

use App\Repository\AdvCategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AdvCategorieRepository::class)]
#[ORM\UniqueConstraint(fields: ['nom_categorie'])]
#[UniqueEntity(fields: ['nom_categorie'], message: 'Cette catégorie existe déjà.')]
class AdvCategorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['api_categorie_index'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['api_voyage_index', 'api_categorie_index'])]
    private ?string $nom_categorie = null;

    /**
     * @var Collection<int, AdvVoyage>
     */
    #[ORM\ManyToMany(targetEntity: AdvVoyage::class, mappedBy: 'categorie')]
    private Collection $advVoyages;

    public function __construct()
    {
        $this->advVoyages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCategorie(): ?string
    {
        return $this->nom_categorie;
    }

    public function setNomCategorie(string $nom_categorie): static
    {
        $this->nom_categorie = $nom_categorie;

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
            $advVoyage->addCategorie($this);
        }

        return $this;
    }

    public function removeAdvVoyage(AdvVoyage $advVoyage): static
    {
        if ($this->advVoyages->removeElement($advVoyage)) {
            $advVoyage->removeCategorie($this);
        }

        return $this;
    }
}
