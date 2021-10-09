<?php

namespace App\Entity\App;

use App\Repository\App\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 * @ORM\Table(name="app_category")
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Envelope::class, inversedBy="categories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $envelope;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=16, nullable=true)
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $icon;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $start_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $end_start;

    /**
     * @ORM\OneToMany(targetEntity=RowVirtual::class, mappedBy="category", orphanRemoval=true)
     */
    private $rowVirtuals;

    public function __construct()
    {
        $this->rowVirtuals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEnvelope(): ?Envelope
    {
        return $this->envelope;
    }

    public function setEnvelope(?Envelope $envelope): self
    {
        $this->envelope = $envelope;

        return $this;
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

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(?\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndStart(): ?\DateTimeInterface
    {
        return $this->end_start;
    }

    public function setEndStart(?\DateTimeInterface $end_start): self
    {
        $this->end_start = $end_start;

        return $this;
    }

    /**
     * @return Collection|RowVirtual[]
     */
    public function getRowVirtuals(): Collection
    {
        return $this->rowVirtuals;
    }

    public function addRowVirtual(RowVirtual $rowVirtual): self
    {
        if (!$this->rowVirtuals->contains($rowVirtual)) {
            $this->rowVirtuals[] = $rowVirtual;
            $rowVirtual->setCategory($this);
        }

        return $this;
    }

    public function removeRowVirtual(RowVirtual $rowVirtual): self
    {
        if ($this->rowVirtuals->removeElement($rowVirtual)) {
            // set the owning side to null (unless already changed)
            if ($rowVirtual->getCategory() === $this) {
                $rowVirtual->setCategory(null);
            }
        }

        return $this;
    }
}
