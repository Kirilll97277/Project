<?php

namespace App\Entity;

use App\Repository\ItemCollectionAttributeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemCollectionAttributeRepository::class)]
class CollectionAttribute
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: AttributeType::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?AttributeType $attributeType;

    #[ORM\OneToMany(mappedBy: 'itemCollectionAttribute', targetEntity: ItemAttribute::class, orphanRemoval: true)]
    private $itemAttributes;

    #[ORM\ManyToOne(targetEntity: Collection::class, inversedBy: 'attributes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Collection $collection;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    public function __construct()
    {
        $this->itemAttributes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getItemAttributes(): ?ArrayCollection
    {
        return $this->itemAttributes;
    }

    public function addItemAttribute(ItemAttribute $itemAttribute): self
    {
        if (!$this->itemAttributes->contains($itemAttribute)) {
            $this->itemAttributes[] = $itemAttribute;
            $itemAttribute->setCollectionAttribute($this);
        }

        return $this;
    }

    public function removeItemAttribute(ItemAttribute $itemAttribute): self
    {
        if ($this->itemAttributes->removeElement($itemAttribute)) {
            // set the owning side to null (unless already changed)
            if ($itemAttribute->getCollectionAttribute() === $this) {
                $itemAttribute->setCollectionAttribute(null);
            }
        }

        return $this;
    }

    public function getCollection(): ?Collection
    {
        return $this->collection;
    }

    public function setCollection(?Collection $collection): self
    {
        $this->collection = $collection;

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

    public function __toString(): string
    {
        return $this->name;
    }
}
