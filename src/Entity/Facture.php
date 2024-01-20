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
    private ?\DateTimeInterface $datePaiement = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $dateCreation = null;
    #[ORM\OneToMany(mappedBy: 'facture', targetEntity: FactureProduit::class)]
    private Collection $produits;

    #[ORM\Column]
    private ?string $prenom = null;
    #[ORM\Column]
    private ?string $nom = null;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(?\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

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

    public function getDatePaiement(): ?\DateTimeInterface
    {
        return $this->datePaiement;
    }

    public function setDatePaiement(?\DateTimeInterface $datePaiement): self
    {
        $this->datePaiement = $datePaiement;

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
            // $factureProduit->setId($this);
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }
}
