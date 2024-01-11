<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?float $stock = null;

    #[ORM\Column(nullable:true)]
    private ?float $min_stock = null;

    #[ORM\OneToMany(mappedBy: 'ingredient', targetEntity: Recette::class)]
    private Collection $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getStock(): ?float
    {
        return $this->stock;
    }

    public function setStock(float $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function getMinStock(): ?float
    {
        return $this->min_stock;
    }

    public function setMinStock(float $min_stock): static
    {
        $this->min_stock = $min_stock;

        return $this;
    }

    /**
     * @return Collection<int, Recette>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Recette $produit): static
    {
        if (!$this->produits->contains($produit)) {
            $this->produits->add($produit);
            $produit->setIngredient($this);
        }

        return $this;
    }

    public function removeProduit(Recette $produit): static
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getIngredient() === $this) {
                $produit->setIngredient(null);
            }
        }

        return $this;
    }
}
