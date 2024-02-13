<?php

namespace App\Repository;

use App\Entity\Facture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query\Expr\Func;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr;
use Symfony\Component\Validator\Constraints\DateTime;


/**
 * @extends ServiceEntityRepository<Facture>
 *
 * @method Facture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Facture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Facture[]    findAll()
 * @method Facture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FactureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Facture::class);
    }

    // RECUPERE TOUT LES FACTURES AVEC L'UTILISATEUR, LES PRODUITS... POUR UN JOUR DONNE
    public function findAllWithUserDetailsAndProducts($selectedDate)
    {
        $queryBuilder = $this->createQueryBuilder('f')
            ->leftJoin('f.user', 'u')
            ->leftJoin('f.produits', 'p');

        if ($selectedDate['type'] === 'dateAchat') {
            $queryBuilder
                ->where('f.dateAchat = :selectedDate')
                ->setParameter('selectedDate', $selectedDate['value']);
        } elseif ($selectedDate['type'] === 'dateReservation') {
            $queryBuilder
                ->where('f.dateReservation = :selectedDate')
                ->setParameter('selectedDate', $selectedDate['value']);
        }

        return $queryBuilder->getQuery()->getResult();
    }

    public function findAllFromDate($selectedDate)
    {
        $queryBuilder = $this->createQueryBuilder('f')
            ->leftJoin('f.user', 'u')
            ->leftJoin('f.produits', 'p');

        if ($selectedDate['type'] === 'dateAchat') {
            $queryBuilder
                ->where('f.dateAchat >= :selectedDate')
                ->setParameter('selectedDate', $selectedDate['value']);
        } elseif ($selectedDate['type'] === 'dateReservation') {
            $queryBuilder
                ->where('f.dateReservation >= :selectedDate')
                ->setParameter('selectedDate', $selectedDate['value']);
        }

        return $queryBuilder->getQuery()->getResult();
    }


    /**
     * Retourne le chiffre d'affaires de l'année en cours.
     *
     * @param \DateTimeInterface $date
     * @return float|null
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function findChiffreAffaireAnneeEnCours(): ?float
    {
        $sql = 'SELECT SUM(montant) as chiffre_affaire FROM facture WHERE YEAR(date_paiement) = YEAR(CURRENT_DATE())';

        $result = $this->getEntityManager()
            ->getConnection()
            ->executeQuery($sql)
            ->fetchOne();

        return $result !== false ? (float) $result : null;
    }

    /**
     * Retourne le chiffre d'affaires de l'année précédente.
     *
     * @return float|null
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function findChiffreAffaireAnneePrecedente(): ?float
    {
        $sql = 'SELECT SUM(montant) as chiffre_affaire FROM facture WHERE YEAR(date_paiement) = YEAR(CURRENT_DATE) - 1';

        $result = $this->getEntityManager()
            ->getConnection()
            ->executeQuery($sql)
            ->fetchOne();

        return $result !== false ? (float) $result : null;
    }

        public function findChiffreAffaireMois(): ?float
    {
        $sql = 'SELECT SUM(montant) as chiffre_affaire FROM facture WHERE MONTH(date_paiement) = MONTH(CURRENT_DATE)';

        $result = $this->getEntityManager()
            ->getConnection()
            ->executeQuery($sql)
            ->fetchOne();

        return $result !== false ? (float) $result : null;
    }

    /**
     * Retourne le top 3 des produits les plus vendus ce mois-ci.
     *
     * @return array
     */
    public function findTop3ProduitsVendusCeMois(): array
    {
        $sql = 'SELECT p.nom, SUM(fp.quantite) as quantite_vendue
                FROM facture_produit fp
                JOIN produit p ON fp.id_produit = p.id
                JOIN facture f ON fp.id_facture = f.id
                WHERE MONTH(f.date_paiement) = MONTH(CURRENT_DATE)
                GROUP BY p.nom
                ORDER BY quantite_vendue DESC
                LIMIT 3';

        $result = $this->getEntityManager()
            ->getConnection()
            ->executeQuery($sql)
            ->fetchAllAssociative();

        return $result;
    }

    // RECUPERE L'ENSEMBLE DES PRODUITS LES PLUS VENDUS DANS LE MOIS DE L'ANNEE AVEC UNE LIMITE EQUIVALENTE A qteProduits
    public function trouverMeilleursProduitsMensuel(int $annee, int $mois, int $qteProduits): array
    {
        $debutMois = new \DateTime("$annee-$mois-01 00:00:00");
        $finMois = clone $debutMois;
        $finMois->modify('last day of this month')->setTime(23, 59, 59);

        return $this->createQueryBuilder('f')
        ->select('p.nom', 'SUM(fp.quantite) as quantite_vendue')
        ->leftJoin('f.produits', 'fp')
        ->leftJoin('fp.produit', 'p')
        ->where('f.dateReservation BETWEEN :debutMois AND :finMois')
        ->setParameter('debutMois', $debutMois)
        ->setParameter('finMois', $finMois)
        ->groupBy('p.nom')
        ->orderBy('quantite_vendue', 'DESC')
        ->setMaxResults($qteProduits)
        ->getQuery()
        ->getResult();
    }

}