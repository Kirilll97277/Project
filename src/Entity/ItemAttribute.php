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

    #[ORM\ManyToOne(targetEntity: Item::class, inversedBy: 'itemAttributes')]
    #[ORM\JoinColumn(nullable: false)]
    private $itemId;

    #[ORM\ManyToOne(targetEntity: ItemCollectionAttribute::class, inversedBy: 'itemAttributes')]
    #[ORM\JoinColumn(nullable: false)]
    private $itemCollectionAttributeId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getItemId(): ?Item
    {
        return $this->itemId;
    }

    public function setItemId(?Item $itemId): self
    {
        $this->itemId = $itemId;

        return $this;
    }

    public function getItemCollectionAttributeId(): ?ItemCollectionAttribute
    {
        return $this->itemCollectionAttributeId;
    }

    public function setItemCollectionAttributeId(?ItemCollectionAttribute $itemCollectionAttributeId): self
    {
        $this->itemCollectionAttributeId = $itemCollectionAttributeId;

        return $this;
    }

}
