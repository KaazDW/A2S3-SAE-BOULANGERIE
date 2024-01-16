<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FactureRepository::class)]
class Facture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'factures')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private ?User $user = null;

    #[ORM\Column]
    private ?float $montant = null;

    #[ORM\Column(type: "date")]
    private ?\DateTimeInterface $dateReservation = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $dateAchat = null;
    #[ORM\OneToMany(mappedBy: 'facture', targetEntity: FactureProduit::class)]
    private Collection $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(int $idUser): static
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDateAchat(): ?\DateTimeInterface
    {
        return $this->dateAchat;
    }

    public function setDateAchat(?\DateTimeInterface $dateAchat): self
    {
        $this->dateAchat = $dateAchat;

        return $this;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->dateReservation;
    }

    public function setDateReservation(?\DateTimeInterface $dateReservation): self
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }

    /**
     * @return Collection<int, FactureProduit>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(FactureProduit $factureProduit): static
    {
        if (!$this->produits->contains($factureProduit)) {
            $this->produits->add($factureProduit);
            $factureProduit->setId($this);
        }

        return $this;
    }

    public function removeProduit(FactureProduit $factureProduit): static
    {
        if ($this->produits->removeElement($factureProduit)) {
            // set the owning side to null (unless already changed)
            if ($factureProduit->getId() === $this) {
                $factureProduit->setId(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): void
    {
        $this->user = $user;
    }


}
