<?php

namespace App\Entity\App;

use App\Repository\App\RowVirtualRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RowVirtualRepository::class)
 * @ORM\Table(name="app_row_virtual")
 */
class RowVirtual
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="rowVirtuals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity=Frequency::class)
     * @ORM\JoinColumn(nullable=false, columnDefinition="INT(11) default '1'")
     */
    private $frequency;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $debit;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modified_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\OneToMany(targetEntity=RowFactual::class, mappedBy="virtual_id", orphanRemoval=true)
     */
    private $rowFactuals;

    public function __construct()
    {
        $this->name         = 'Nouvelle ligne';
        $this->value        = 0;
        $this->created_at   = new \DateTime();
        $this->rowFactuals  = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

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

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getFrequency(): ?Frequency
    {
        return $this->frequency;
    }

    public function setFrequency(?Frequency $frequency): self
    {
        $this->frequency = $frequency;

        return $this;
    }

    public function getDebit(): ?bool
    {
        return $this->debit;
    }

    public function setDebit(?bool $debit): self
    {
        $this->debit = $debit;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection|RowFactual[]
     */
    public function getRowFactuals(): Collection
    {
        return $this->rowFactuals;
    }

    public function addRowFactual(RowFactual $rowFactual): self
    {
        if (!$this->rowFactuals->contains($rowFactual)) {
            $this->rowFactuals[] = $rowFactual;
            $rowFactual->setVirtualId($this);
        }

        return $this;
    }

    public function removeRowFactual(RowFactual $rowFactual): self
    {
        if ($this->rowFactuals->removeElement($rowFactual)) {
            // set the owning side to null (unless already changed)
            if ($rowFactual->getVirtualId() === $this) {
                $rowFactual->setVirtualId(null);
            }
        }

        return $this;
    }
}
