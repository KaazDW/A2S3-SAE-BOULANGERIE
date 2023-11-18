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
    #[ORM\JoinColumn(nullable: false)]
    private ?Produit $idProduit = null;

    #[ORM\ManyToOne(inversedBy: 'factureProduits')]
    private ?Facture $idFacture = null;

    #[ORM\Column]
    private ?int $quantite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdProduit(): ?Produit
    {
        return $this->idProduit;
    }

    public function setIdProduit(?Produit $idProduit): static
    {
        $this->idProduit = $idProduit;

        return $this;
    }

    public function getIdFacture(): ?Facture
    {
        return $this->idFacture;
    }

    public function setIdFacture(?Facture $idFacture): static
    {
        $this->idFacture = $idFacture;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }
}
