<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'Cet email est déjà utilisé.')]
#[UniqueEntity(fields: ['telephone_utilisateur'], message: 'Ce téléphone est déjà utilisé.')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    #[Groups(['api_reservation_new'])]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column(nullable: true)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    #[Groups(['api_reservation_new'])]
    private ?string $nom_utilisateur = null;

    #[ORM\Column(length: 255)]
    #[Groups(['api_reservation_new'])]
    private ?string $prenom_utilisateur = null;

    #[ORM\Column(length: 15, nullable: true)]
    #[Groups(['api_reservation_new'])]
    private ?string $telephone_utilisateur = null;

    /**
     * @var Collection<int, AdvVoyage>
     */
    #[ORM\OneToMany(targetEntity: AdvVoyage::class, mappedBy: 'user')]
    private Collection $advVoyages;

    /**
     * @var Collection<int, AdvReservation>
     */
    #[ORM\OneToMany(targetEntity: AdvReservation::class, mappedBy: 'user')]
    private Collection $advReservations;

    public function __construct()
    {
        $this->advVoyages = new ArrayCollection();
        $this->advReservations = new ArrayCollection();
    }

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

    public function getNomUtilisateur(): ?string
    {
        return $this->nom_utilisateur;
    }

    public function setNomUtilisateur(string $nom_utilisateur): static
    {
        $this->nom_utilisateur = $nom_utilisateur;

        return $this;
    }

    public function getPrenomUtilisateur(): ?string
    {
        return $this->prenom_utilisateur;
    }

    public function setPrenomUtilisateur(string $prenom_utilisateur): static
    {
        $this->prenom_utilisateur = $prenom_utilisateur;

        return $this;
    }

    public function getTelephoneUtilisateur(): ?string
    {
        return $this->telephone_utilisateur;
    }

    public function setTelephoneUtilisateur(?string $telephone_utilisateur): static
    {
        $this->telephone_utilisateur = $telephone_utilisateur;

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
            $advVoyage->setUser($this);
        }

        return $this;
    }

    public function removeAdvVoyage(AdvVoyage $advVoyage): static
    {
        if ($this->advVoyages->removeElement($advVoyage)) {
            // set the owning side to null (unless already changed)
            if ($advVoyage->getUser() === $this) {
                $advVoyage->setUser(null);
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
            $advReservation->setUser($this);
        }

        return $this;
    }

    public function removeAdvReservation(AdvReservation $advReservation): static
    {
        if ($this->advReservations->removeElement($advReservation)) {
            // set the owning side to null (unless already changed)
            if ($advReservation->getUser() === $this) {
                $advReservation->setUser(null);
            }
        }

        return $this;
    }
}
