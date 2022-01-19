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

    #[ORM\ManyToMany(targetEntity: User::class)]
    private $Item_like;

    #[ORM\ManyToMany(targetEntity: Tags::class, inversedBy: 'items')]
    private $Tags;

    #[ORM\Column(type: 'datetime')]
    private $create_date;


    public function __construct()
    {
        $this->Item_like = new ArrayCollection();
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


    /**
     * @return ArrayCollection
     */
    public function getItemLike(): ArrayCollection
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
     * @return ArrayCollection
     */
    public function getTags(): ArrayCollection
    {
        return $this->Tags;
    }

    public function addTag(Tags $tag): self
    {
        if (!$this->Tags->contains($tag)) {
            $this->Tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tags $tag): self
    {
        $this->Tags->removeElement($tag);

        return $this;
    }

    public function getCreateDate(): string
    {
        return $this->create_date;
    }

    public function setCreateDate(string $create_date): self
    {
        $this->create_date = $create_date;

        return $this;
    }

}
