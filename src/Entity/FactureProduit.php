<?php

namespace App\Entity;

use App\Repository\FactureProduitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FactureProduitRepository::class)]
class FactureProduit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'factureProduits')]
    #[ORM\JoinColumn(name: 'id_produit', referencedColumnName: 'id', nullable: false)]
    private ?Produit $produit = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    #[ORM\JoinColumn(name: 'id_facture', referencedColumnName: 'id', nullable: false)]
    private ?Facture $facture = null;

    #[ORM\Column]
    private ?int $quantite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

//    /**
//     * @param int|null $id
//     * @param Produit|null $produit
//     * @param Facture|null $facture
//     * @param int|null $quantite
//     */
//    public function __construct(?int $id, ?Produit $produit, ?Facture $facture, ?int $quantite)
//    {
//        $this->id = $id;
//        $this->produit = $produit;
//        $this->facture = $facture;
//        $this->quantite = $quantite;
//    }



    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): void
    {
        $this->produit = $produit;
    }

    public function getFacture(): ?Facture
    {
        return $this->facture;
    }

    public function setFacture(?Facture $facture): void
    {
        $this->facture = $facture;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(?int $quantite): void
    {
        $this->quantite = $quantite;
    }

    // Ajout de méthodes pour récupérer le nom de l'ingrédient et la quantité
    public function getNomProduit(): ?string
    {
        // Vérifier si l'association Produit est définie
        return $this->produit ? $this->produit->getNom() : null;
    }


}
