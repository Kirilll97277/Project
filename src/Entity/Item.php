<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
class Item
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\ManyToOne(targetEntity: Collection::class)]
    private $Collection;

    #[ORM\OneToMany(mappedBy: 'item', targetEntity: tags::class)]
    private $Tags;

    #[ORM\ManyToOne(targetEntity: User::class)]
    private $like_Item;

    public function __construct()
    {
        $this->Tags = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getLikeItem(): ?User
    {
        return $this->like_Item;
    }

    public function setLikeItem(?User $like_Item): self
    {
        $this->like_Item = $like_Item;

        return $this;
    }

}
