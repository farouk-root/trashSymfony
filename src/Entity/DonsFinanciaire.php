<?php

namespace App\Entity;

use App\Repository\DonsFinanciaireRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DonsFinanciaireRepository::class)]
class DonsFinanciaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank(message:"Titre cannot be blank")]
    #[Assert\Length(
        min: 1,
        max: 15,
        minMessage: 'insuffisant {{ limit }}',
        maxMessage: 'trop long {{ limit }} ',
    )]
    #[Assert\Regex(
        pattern: '/^[a-z]+$/i',
        message: 'le titre du don ne contient pas des nombre',
        match: true
    )]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titre = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message:"Description cannot be blank")]
    #[Assert\Length(
        min: 50,
        max: 255,
        minMessage: 'insuffisant {{ limit }}',
        maxMessage: 'trop long {{ limit }} ',
    )]
    private ?string $Description = null;

    #[ORM\Column(nullable: true)]
    #[Assert\NotBlank(message:"Montant cannot be blank")]
    #[Assert\Type(type:"float", message:"Montant must be a float")]
    private ?float $montant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(?float $montant): static
    {
        $this->montant = $montant;

        return $this;
    }
}
