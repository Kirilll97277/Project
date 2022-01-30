<?php

namespace App\Entity;

use App\Repository\CollectionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

#[ORM\Entity(repositoryClass: CollectionsRepository::class)]
class Collection
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
    private $user;

    #[ORM\ManyToOne(targetEntity: Theme::class)]
    private $theme;

    #[ORM\OneToMany(mappedBy: 'collection', targetEntity: CollectionAttribute::class, orphanRemoval: true, cascade:['persist'])]
    protected $attributes;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $uploadAd;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image_id;

    public function __construct()
    {
        $this->attributes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        if (empty($this->created_at)) {
            $date = new \DateTime();
            $this->created_at = $date;
        }
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
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTheme(): ?Theme
    {
        return $this->theme;
    }

    public function setTheme(?Theme $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * @return PersistentCollection|CollectionAttribute[]
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    public function addAttribute(CollectionAttribute $attribute): self
    {
        if (!$this->attributes->contains($attribute)) {
            $this->attributes[] = $attribute;
            $attribute->setCollection($this);
        }

        return $this;
    }

    public function removeAttribute(CollectionAttribute $itemAttribute): self
    {
        if ($this->attributes->removeElement($itemAttribute)) {
            // set the owning side to null (unless already changed)
            if ($itemAttribute->getCollection() === $this) {
                $itemAttribute->setCollection(null);
            }
        }

        return $this;
    }

    public function getUploadAd(): ?\DateTimeInterface
    {
        return $this->uploadAd;
    }

    public function setUploadAd(?\DateTimeInterface $uploadAd): self
    {
        $this->uploadAd = $uploadAd;

        return $this;
    }

    public function getImageId(): ?string
    {
        return $this->image_id;
    }

    public function setImageId(?string $image_id): self
    {
        $this->image_id = $image_id;

        return $this;
    }

}
