<?php

namespace App\Entity;

use App\Repository\ItemAttributeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemAttributeRepository::class)]
class ItemAttribute
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $value;

    #[ORM\ManyToOne(targetEntity: Item::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $Item;

    #[ORM\ManyToOne(targetEntity: ItemCollectionAttribute::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $ItemCollectionAttribute;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

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

    public function getItemCollectionAttribute(): ?ItemCollectionAttribute
    {
        return $this->ItemCollectionAttribute;
    }

    public function setItemCollectionAttribute(?ItemCollectionAttribute $ItemCollectionAttribute): self
    {
        $this->ItemCollectionAttribute = $ItemCollectionAttribute;

        return $this;
    }
}
