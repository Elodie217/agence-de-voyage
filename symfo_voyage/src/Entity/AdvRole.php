<?php

namespace App\Entity;

use App\Repository\AdvRoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdvRoleRepository::class)]
class AdvRole
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_role = null;

    /**
     * @var Collection<int, AdvUtilisateur>
     */
    #[ORM\OneToMany(targetEntity: AdvUtilisateur::class, mappedBy: 'role')]
    private Collection $advUtilisateurs;

    public function __construct()
    {
        $this->advUtilisateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomRole(): ?string
    {
        return $this->nom_role;
    }

    public function setNomRole(string $nom_role): static
    {
        $this->nom_role = $nom_role;

        return $this;
    }

    /**
     * @return Collection<int, AdvUtilisateur>
     */
    public function getAdvUtilisateurs(): Collection
    {
        return $this->advUtilisateurs;
    }

    public function addAdvUtilisateur(AdvUtilisateur $advUtilisateur): static
    {
        if (!$this->advUtilisateurs->contains($advUtilisateur)) {
            $this->advUtilisateurs->add($advUtilisateur);
            $advUtilisateur->setRole($this);
        }

        return $this;
    }

    public function removeAdvUtilisateur(AdvUtilisateur $advUtilisateur): static
    {
        if ($this->advUtilisateurs->removeElement($advUtilisateur)) {
            // set the owning side to null (unless already changed)
            if ($advUtilisateur->getRole() === $this) {
                $advUtilisateur->setRole(null);
            }
        }

        return $this;
    }
}
