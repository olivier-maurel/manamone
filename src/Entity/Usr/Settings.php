<?php

namespace App\Entity\Usr;

use App\Repository\SettingsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SettingsRepository::class)
 * @ORM\Table(name="usr_settings")
 */
class Settings
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="settings", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $dark_mode;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $language;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $news_email;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $news_phone;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $modified_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getDarkMode(): ?bool
    {
        return $this->dark_mode;
    }

    public function setDarkMode(?bool $dark_mode): self
    {
        $this->dark_mode = $dark_mode;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function getNewsEmail(): ?bool
    {
        return $this->news_email;
    }

    public function setNewsEmail(?bool $news_email): self
    {
        $this->news_email = $news_email;

        return $this;
    }

    public function getNewsPhone(): ?bool
    {
        return $this->news_phone;
    }

    public function setNewsPhone(?bool $news_phone): self
    {
        $this->news_phone = $news_phone;

        return $this;
    }

    public function getModifiedAt(): ?\DateTimeInterface
    {
        return $this->modified_at;
    }

    public function setModifiedAt(?\DateTimeInterface $modified_at): self
    {
        $this->modified_at = $modified_at;

        return $this;
    }

}
