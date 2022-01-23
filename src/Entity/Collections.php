<?php

namespace App\Entity;

use App\Repository\CollectionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CollectionsRepository::class)]
class Collections
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'string', length: 500, nullable: true)]
    private $image;

    #[ORM\ManyToOne(targetEntity: User::class)]
    private $User;

    #[ORM\ManyToOne(targetEntity: Theme::class)]
    private $Theme;

    #[ORM\OneToMany(mappedBy: 'collectionId', targetEntity: ItemCollectionAttribute::class, orphanRemoval: true, cascade:['persist'])]
    private $itemCollectionAttributes;

    public function __construct()
    {
        $this->itemCollectionAttributes = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getTheme(): ?Theme
    {
        return $this->Theme;
    }

    public function setTheme(?Theme $Theme): self
    {
        $this->Theme = $Theme;

        return $this;
    }

    /**
     * @return Collection|ItemCollectionAttribute[]
     */
    public function getItemCollectionAttributes(): Collection
    {
        return $this->itemCollectionAttributes;
    }

    public function addItemCollectionAttribute(ItemCollectionAttribute $itemCollectionAttribute): self
    {
        if (!$this->itemCollectionAttributes->contains($itemCollectionAttribute)) {
            $this->itemCollectionAttributes[] = $itemCollectionAttribute;
            $itemCollectionAttribute->setCollectionId($this);
        }

        return $this;
    }

    public function removeItemCollectionAttribute(ItemCollectionAttribute $itemCollectionAttribute): self
    {
        if ($this->itemCollectionAttributes->removeElement($itemCollectionAttribute)) {
            // set the owning side to null (unless already changed)
            if ($itemCollectionAttribute->getCollectionId() === $this) {
                $itemCollectionAttribute->setCollectionId(null);
            }
        }

        return $this;
    }

}
