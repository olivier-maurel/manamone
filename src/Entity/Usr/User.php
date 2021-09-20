<?php

namespace App\Entity\Usr;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $lastname;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $last_log;

    /**
     * @ORM\Column(type="date")
     */
    private $created_at;

    /**
     * @ORM\OneToOne(targetEntity=Contact::class, mappedBy="user_id", cascade={"persist", "remove"})
     */
    private $contact;

    /**
     * @ORM\OneToOne(targetEntity=Settings::class, mappedBy="user_id", cascade={"persist", "remove"})
     */
    private $settings;

    /**
     * @ORM\OneToMany(targetEntity=AddrIp::class, mappedBy="user_id")
     */
    private $addrIps;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    public function __construct()
    {
        $this->addrIps = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
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
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
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

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getLastLog(): ?\DateTimeInterface
    {
        return $this->last_log;
    }

    public function setLastLog(?\DateTimeInterface $last_log): self
    {
        $this->last_log = $last_log;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(Contact $contact): self
    {
        // set the owning side of the relation if necessary
        if ($contact->getUserId() !== $this) {
            $contact->setUserId($this);
        }

        $this->contact = $contact;

        return $this;
    }

    public function getSettings(): ?Settings
    {
        return $this->settings;
    }

    public function setSettings(Settings $settings): self
    {
        // set the owning side of the relation if necessary
        if ($settings->getUserId() !== $this) {
            $settings->setUserId($this);
        }

        $this->settings = $settings;

        return $this;
    }

    /**
     * @return Collection|AddrIp[]
     */
    public function getAddrIps(): Collection
    {
        return $this->addrIps;
    }

    public function addAddrIp(AddrIp $addrIp): self
    {
        if (!$this->addrIps->contains($addrIp)) {
            $this->addrIps[] = $addrIp;
            $addrIp->setUserId($this);
        }

        return $this;
    }

    public function removeAddrIp(AddrIp $addrIp): self
    {
        if ($this->addrIps->removeElement($addrIp)) {
            // set the owning side to null (unless already changed)
            if ($addrIp->getUserId() === $this) {
                $addrIp->setUserId(null);
            }
        }

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }
}
