<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

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
    private $likes;

    #[ORM\ManyToMany(targetEntity: Tags::class, inversedBy: 'items', cascade:['persist'])]
    private $tags;

    #[ORM\Column(type: 'datetime')]
    private $createDate;

    #[ORM\ManyToOne(targetEntity: Collection::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $collection;

    #[ORM\OneToMany(mappedBy: 'item', targetEntity: ItemAttribute::class, orphanRemoval: true, cascade:['persist'])]
    private $attributes;

    public function __construct()
    {
        $this->likes = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->attributes = new ArrayCollection();
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
    public function getLikes(): ArrayCollection
    {
        return $this->likes;
    }

    public function addItemLike(User $itemLike): self
    {
        if (!$this->likes->contains($itemLike)) {
            $this->likes[] = $itemLike;
        }

        return $this;
    }

    public function removeItemLike(User $itemLike): self
    {
        $this->likes->removeElement($itemLike);

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getTags(): ArrayCollection
    {
        return $this->tags;
    }

    public function addTag(Tags $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tags $tag): self
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    public function getCreateDate(): \DateTimeInterface
    {
        return $this->createDate;
    }

    public function setCreateDate(\DateTimeInterface $createDate): self
    {
        $this->createDate = $createDate;

        return $this;
    }

    /**
     * @return PersistentCollection|ItemAttribute[]
     */
    public function getAttributes(): ?PersistentCollection
    {
        return $this->attributes;
    }

    public function addItemAttribute(ItemAttribute $itemAttribute): self
    {
        if (!$this->attributes->contains($itemAttribute)) {
            $this->attributes[] = $itemAttribute;
            $itemAttribute->setItem($this);
        }

        return $this;
    }

    public function removeItemAttribute(ItemAttribute $itemAttribute): self
    {
        if ($this->attributes->removeElement($itemAttribute)) {
            // set the owning side to null (unless already changed)
            if ($itemAttribute->getItemId() === $this) {
                $itemAttribute->setItemId(null);
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

}
