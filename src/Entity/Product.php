<?php

namespace App\Entity;

class Product
{
    /** @var int|null numéro du produit */
    private ?int $id;

    /** @var string|null nom du produit */
    private ?string $name;

    /** @var string|null description du produit */
    private ?string $description;

    /** @var \DateTimeImmutable date d'ajout au catalogue */
    private \DateTimeImmutable $createdAt;

    /** @var int|null quantité en stock */
    private ?int $quantityInStock;

    /** @var float|null prix HT */
    private ?float $price;

    /** @var string|null nom de l'image */
    private ?string $imageName;
}