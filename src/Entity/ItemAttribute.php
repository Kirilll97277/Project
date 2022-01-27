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

    #[ORM\ManyToOne(targetEntity: CollectionAttribute::class, inversedBy: 'itemAttributes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CollectionAttribute $collectionAttribute;

    #[ORM\Column(type: 'string', length: 255)]
    protected $value;

    #[ORM\ManyToOne(targetEntity: Item::class, inversedBy: 'itemAttributes')]
    #[ORM\JoinColumn(nullable: false)]
    private $item;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCollectionAttribute(): ?CollectionAttribute
    {
        return $this->collectionAttribute;
    }

    public function setCollectionAttribute(?CollectionAttribute $collectionAttribute): self
    {
        $this->collectionAttribute = $collectionAttribute;

        return $this;
    }

    public function getItem(): ?Item
    {
        return $this->item;
    }

    public function setItem(?Item $item): self
    {
        $this->item = $item;

        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value): void
    {
        if ($value instanceof \DateTimeInterface) {
            $value = $value->format('d-m-Y');
        }

        $this->value = (string) $value;
    }
}
