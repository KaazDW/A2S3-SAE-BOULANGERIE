<?php

namespace App\Repository;

use App\Entity\Facture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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

//    /**
//     * @return Facture[] Returns an array of Facture objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Facture
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
