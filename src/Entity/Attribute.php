<?php

namespace App\Entity;

use App\Repository\AttributeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AttributeRepository::class)]
class Attribute
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Name;

    #[ORM\ManyToOne(targetEntity: AttributeType::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $AttributeType;

    #[ORM\ManyToOne(targetEntity: AttributeValue::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $AttributeValue;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

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

    public function getAttributeValue(): ?AttributeValue
    {
        return $this->AttributeValue;
    }

    public function setAttributeValue(?AttributeValue $AttributeValue): self
    {
        $this->AttributeValue = $AttributeValue;

        return $this;
    }
}
