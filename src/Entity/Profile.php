<?php

namespace App\Entity;

use App\Repository\ProfileRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfileRepository::class)]
class Profile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?User $Id = null;

    #[ORM\Column(length: 255)]
    private ?string $skills = null;

    #[ORM\Column(length: 255)]
    private ?string $experiences = null;

    #[ORM\Column(length: 255)]
    private ?string $localisation = null;

    #[ORM\Column(length: 255)]
    private ?string $createdAT = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?User $Id): static
    {
        $this->Id = $Id;

        return $this;
    }

    public function getSkills(): ?string
    {
        return $this->skills;
    }

    public function setSkills(string $skills): static
    {
        $this->skills = $skills;

        return $this;
    }

    public function getExperiences(): ?string
    {
        return $this->experiences;
    }

    public function setExperiences(string $experiences): static
    {
        $this->experiences = $experiences;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): static
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getCreatedAT(): ?string
    {
        return $this->createdAT;
    }

    public function setCreatedAT(string $createdAT): static
    {
        $this->createdAT = $createdAT;

        return $this;
    }
}
