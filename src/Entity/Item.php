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

//    #[ORM\OneToMany(mappedBy: 'item', targetEntity: tags::class)]
//    private $Tags;

    #[ORM\ManyToMany(targetEntity: User::class)]
    private $Item_like;

    public function __construct()
    {
        $this->Tags = new ArrayCollection();
        $this->Item_like = new ArrayCollection();
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

    /**
     * @return Collection|User[]
     */
    public function getItemLike(): Collection
    {
        return $this->Item_like;
    }

    public function addItemLike(User $itemLike): self
    {
        if (!$this->Item_like->contains($itemLike)) {
            $this->Item_like[] = $itemLike;
        }

        return $this;
    }

    public function removeItemLike(User $itemLike): self
    {
        $this->Item_like->removeElement($itemLike);

        return $this;
    }
}
