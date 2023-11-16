<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=IngredientRepository::class)
 */
class Ingredient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id_ingredient", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="stock_kg", type="float", scale=2)
     */
    private $stockKg;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;
    
    /**
     * @ORM\ManyToMany(targetEntity=Produit::class, mappedBy="ingredients")
     */
    private $produits;

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

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getStockKg(): ?float
    {
        return $this->stockKg;
    }

    public function setStockKg(float $stockKg): self
    {
        $this->stockKg = $stockKg;

        return $this;
    }

        /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->addIngredient($this);
        }
    
        return $this;
    }
    
    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            $produit->removeIngredient($this);
        }
    
        return $this;
    }
}
