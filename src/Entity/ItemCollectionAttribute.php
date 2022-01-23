<?php

namespace App\Entity;

use App\Repository\ItemCollectionAttributeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
//use Doctrine\Common\Collections\Collections;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemCollectionAttributeRepository::class)]
class ItemCollectionAttribute
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;


    #[ORM\ManyToOne(targetEntity: AttributeType::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $attributeTypeId;

    #[ORM\OneToMany(mappedBy: 'itemCollectionAttributeId', targetEntity: ItemAttribute::class, orphanRemoval: true)]
    private $itemAttributes;

    #[ORM\ManyToOne(targetEntity: Collections::class, inversedBy: 'itemCollectionAttributes')]
    #[ORM\JoinColumn(nullable: false)]
    private $collectionId;

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



    public function getAttributeTypeId(): ?AttributeType
    {
        return $this->attributeTypeId;
    }

    public function setAttributeTypeId(?AttributeType $attributeTypeId): self
    {
        $this->attributeTypeId = $attributeTypeId;

        return $this;
    }

    /**
     * @return Collection|ItemAttribute[]
     */
    public function getItemAttributes(): Collection
    {
        return $this->itemAttributes;
    }

    public function addItemAttribute(ItemAttribute $itemAttribute): self
    {
        if (!$this->itemAttributes->contains($itemAttribute)) {
            $this->itemAttributes[] = $itemAttribute;
            $itemAttribute->setItemCollectionAttributeId($this);
        }

        return $this;
    }

    public function removeItemAttribute(ItemAttribute $itemAttribute): self
    {
        if ($this->itemAttributes->removeElement($itemAttribute)) {
            // set the owning side to null (unless already changed)
            if ($itemAttribute->getItemCollectionAttributeId() === $this) {
                $itemAttribute->setItemCollectionAttributeId(null);
            }
        }

        return $this;
    }

    public function getCollectionId(): ?Collections
    {
        return $this->collectionId;
    }

    public function setCollectionId(?Collections $collectionId): self
    {
        $this->collectionId = $collectionId;

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


}
