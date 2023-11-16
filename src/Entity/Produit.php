<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id_produit", type="integer")
     */
    private $id;

    /**
    * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(name="prix",type="float")
     */
    private $prixUnitaire;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $QteEnStock;

    /**
     * @ORM\ManyToMany(targetEntity=Ingredient::class, inversedBy="produits")
     * @ORM\JoinTable(name="produit_ingredient",
     *      joinColumns={@ORM\JoinColumn(name="id_produit", referencedColumnName="id_produit")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_ingredient", referencedColumnName="id_ingredient")}
     * )
     */
    private $ingredients;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nomProduit): self
    {
        $this->nom = $nomProduit;

        return $this;
    }

    public function getPrixUnitaire(): ?float
    {
        return $this->prixUnitaire;
    }

    public function setPrixUnitaire(float $prixUnitaire): self
    {
        $this->prixUnitaire = $prixUnitaire;

        return $this;
    }

    public function getQteEnStock(): ?int
    {
        return $this->QteEnStock;
    }

    public function setQteEnStock(?int $QteEnStock): self
    {
        $this->QteEnStock = $QteEnStock;

        return $this;
    }

        /**
     * @return Collection|Ingredient[]
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients[] = $ingredient;
            $ingredient->addProduit($this);
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): self
    {
        if ($this->ingredients->removeElement($ingredient)) {
            $ingredient->removeProduit($this);
        }

        return $this;
    }

}
