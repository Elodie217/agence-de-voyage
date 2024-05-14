<?php

namespace App\Repository;

use App\Entity\AdvVoyage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AdvVoyage>
 */
class AdvVoyageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdvVoyage::class);
    }

    public function dernierVoyages()
    {
        return $this->createQueryBuilder('a')

            ->orderBy('a.id', 'DESC') // Trie par ID dans l'ordre décroissant
            ->setMaxResults(3) // Limite les résultats à 3

            ->getQuery()
            ->getResult();
    }

    // public function findAllByParameters($categorieId, $paysId)
    // {
    //     if ($categorieId == "all") {
    //         if ($paysId == "all") {
    //             // ici on retourne tous les pays et toutes les catégories
    //             return $this->createQueryBuilder('a')
    //                 ->orderBy('a.id', 'ASC')

    //                 ->getQuery()
    //                 ->getResult();
    //         } else {
    //             // ici on retourne que le pays concerné et toutes les catégories
    //             return $this->createQueryBuilder('a')
    //                 ->join('a.pays', 'd')
    //                 ->andWhere('d.id = :paysId')
    //                 ->setParameter('paysId', $paysId)

    //                 ->orderBy('a.id', 'ASC')

    //                 ->getQuery()
    //                 ->getResult();
    //         }
    //     } else {
    //         if ($paysId == "all") {
    //             // ici on retourne tous les pays et la catégorie concernée
    //             return $this->createQueryBuilder('a')
    //                 ->join('a.categorie', 'c')
    //                 ->andWhere('c.id = :categorieId')
    //                 ->setParameter('categorieId', $categorieId)

    //                 ->orderBy('a.id', 'ASC')

    //                 ->getQuery()
    //                 ->getResult();
    //         } else {
    //             // ici on retourne le pays concerné et la catégorie concernée

    //             return $this->createQueryBuilder('a')

    //                 ->join('a.categorie', 'c')
    //                 ->andWhere('c.id = :categorieId')
    //                 ->setParameter('categorieId', $categorieId)
    //                 ->join('a.pays', 'd')
    //                 ->andWhere('d.id = :paysId')
    //                 ->setParameter('paysId', $paysId)

    //                 ->orderBy('a.id', 'ASC')

    //                 ->getQuery()
    //                 ->getResult();
    //         }
    //     }
    // }

    public function findAllByParameters($categorieId, $paysId, $ordre, $dureeVoyage)
    {
        $qb = $this->createQueryBuilder('a')
            ->orderBy('a.id', 'ASC');
        if ($categorieId !== "all") {
            // ici on retourne la catégorie concernée
            $qb->join('a.categorie', 'c')
                ->andWhere('c.id = :categorieId')
                ->setParameter('categorieId', $categorieId);
        }
        if ($paysId !== "all") {
            // ici on retourne que le pays concerné 
            $qb->join('a.pays', 'd')
                ->andWhere('d.id = :paysId')
                ->setParameter('paysId', $paysId);
        }
        if ($ordre == "min" && $dureeVoyage !== "all") {
            // ici on retourne que le pays concerné 
            $qb->andWhere('a.duree_voyage >= :dureeVoyage')
                ->setParameter('dureeVoyage', $dureeVoyage);
        } else if ($ordre == "max" && $dureeVoyage !== "all") {
            // ici on retourne que le pays concerné 
            $qb->andWhere('a.duree_voyage <= :dureeVoyage')
                ->setParameter('dureeVoyage', $dureeVoyage);
        }
        return $qb
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return AdvVoyage[] Returns an array of AdvVoyage objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?AdvVoyage
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
