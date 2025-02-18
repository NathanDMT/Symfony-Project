<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    /** @var int|null numéro du produit */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    /** @var string|null nom du produit */
    #[ORM\Column]
    private ?string $name;

    /** @var string|null description du produit */
    #[ORM\Column(nullable: true, length: 2000)]
    private ?string $description;

    /** @var \DateTimeImmutable date d'ajout au catalogue */
    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    /** @var int|null quantité en stock */
    #[ORM\Column(nullable: true)]
    private ?int $quantityInStock;

    /** @var float|null prix HT */
    #[ORM\Column(type: 'integer')]
    private ?float $price;

    /** @var string|null nom de l'image */
    #[ORM\Column(nullable: true)]
    private ?string $imageName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): Product
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): Product
    {
        $this->description = $description;
        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): Product
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getQuantityInStock(): ?int
    {
        return $this->quantityInStock;
    }

    public function setQuantityInStock(?int $quantityInStock): Product
    {
        $this->quantityInStock = $quantityInStock;
        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): Product
    {
        $this->price = $price;
        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): Product
    {
        $this->imageName = $imageName;
        return $this;
    }


}