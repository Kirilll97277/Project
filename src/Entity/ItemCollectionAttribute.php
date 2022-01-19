<?php

namespace App\Entity;

use App\Repository\ItemCollectionAttributeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemCollectionAttributeRepository::class)]
class ItemCollectionAttribute
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'boolean')]
    private $isActive;

    #[ORM\ManyToOne(targetEntity: AttributeType::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $AttributeType;

    #[ORM\ManyToOne(targetEntity: Collection::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $Collection;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getAttributeType(): ?AttributeType
    {
        return $this->AttributeType;
    }

    public function setAttributeType(?AttributeType $AttributeType): self
    {
        $this->AttributeType = $AttributeType;

        return $this;
    }

    public function getCollection(): ?Collection
    {
        return $this->Collection;
    }

    public function setCollection(?Collection $Collection): self
    {
        $this->Collection = $Collection;

        return $this;
    }
}
