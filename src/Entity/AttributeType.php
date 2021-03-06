<?php

namespace App\Entity;

use App\Repository\AttributeTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AttributeTypeRepository::class)]
class AttributeType
{
    public const INTEGER_TYPE = 'INTEGER';
    public const BOOLEAN_TYPE = 'BOOLEAN';
    public const DATE_TYPE = 'DATE';
    public const TEXT_TYPE = 'TEXT';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;


    public function getId(): ?int
    {
        return $this->id;
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
