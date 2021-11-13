<?php

namespace App\Entity\App;

use App\Repository\App\FrequencyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FrequencyRepository::class)
 * @ORM\Table(name="app_frequency")
 */
class Frequency
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $calcul;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $code;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->name;
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }
}
