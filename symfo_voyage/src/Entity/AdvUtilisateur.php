<?php

namespace App\Entity;

use App\Repository\AdvUtilisateurRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: AdvUtilisateurRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class AdvUtilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 15, nullable: true)]
    private ?string $telephone = null;

    /**
     * @var Collection<int, AdvVoyage>
     */
    #[ORM\OneToMany(targetEntity: AdvVoyage::class, mappedBy: 'utilisateur')]
    private Collection $advVoyages;

    /**
     * @var Collection<int, AdvReservation>
     */
    #[ORM\OneToMany(targetEntity: AdvReservation::class, mappedBy: 'utilisateur')]
    private Collection $advReservations;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): static
    {
        $this->telephone = $telephone;

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
            $advVoyage->setUtilisateur($this);
        }

        return $this;
    }

    public function removeAdvVoyage(AdvVoyage $advVoyage): static
    {
        if ($this->advVoyages->removeElement($advVoyage)) {
            // set the owning side to null (unless already changed)
            if ($advVoyage->getUtilisateur() === $this) {
                $advVoyage->setUtilisateur(null);
            }
        }

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
            $advReservation->setUtilisateur($this);
        }

        return $this;
    }

    public function removeAdvReservation(AdvReservation $advReservation): static
    {
        if ($this->advReservations->removeElement($advReservation)) {
            // set the owning side to null (unless already changed)
            if ($advReservation->getUtilisateur() === $this) {
                $advReservation->setUtilisateur(null);
            }
        }

        return $this;
    }
}
