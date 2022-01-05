<?php

namespace App\Entity;

use App\Repository\AttributeValueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AttributeValueRepository::class)]
class AttributeValue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $value;

    #[ORM\ManyToOne(targetEntity: AttributeType::class)]
    private $attributeType;

    #[ORM\ManyToOne(targetEntity: Item::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $Item;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getAttributeType(): ?AttributeType
    {
        return $this->attributeType;
    }

    public function setAttributeType(?AttributeType $attributeType): self
    {
        $this->attributeType = $attributeType;

        return $this;
    }

    public function getItem(): ?Item
    {
        return $this->Item;
    }

    public function setItem(?Item $Item): self
    {
        $this->Item = $Item;

        return $this;
    }
}
