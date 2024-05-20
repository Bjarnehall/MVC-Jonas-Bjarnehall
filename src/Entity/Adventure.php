<?php

namespace App\Entity;

use App\Repository\AdventureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdventureRepository::class)]
class Adventure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $notes = null;

    #[ORM\Column(nullable: true)]
    private ?int $codes = null;

    #[ORM\Column(nullable: true)]
    private ?int $keys = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): static
    {
        $this->notes = $notes;

        return $this;
    }

    public function getCodes(): ?int
    {
        return $this->codes;
    }

    public function setCodes(?int $codes): static
    {
        $this->codes = $codes;

        return $this;
    }

    public function getKeys(): ?int
    {
        return $this->keys;
    }

    public function setKeys(?int $keys): static
    {
        $this->keys = $keys;

        return $this;
    }
}
