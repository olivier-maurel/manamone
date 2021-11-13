<?php

namespace App\Entity\App;

use App\Repository\App\CategoryTemplateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryTemplateRepository::class)
 * @ORM\Table(name="app_category_template")
 */
class CategoryTemplate
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=16, unique=true, nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $calcul;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $icon;

    public function __toString()
    {
        return $this->id;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCalcul(): ?string
    {
        return $this->calcul;
    }

    public function setCalcul(string $calcul): self
    {
        $this->calcul = $calcul;

        return $this;
    }

  
    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }
}
