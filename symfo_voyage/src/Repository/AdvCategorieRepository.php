<?php

namespace App\Repository;

use App\Entity\AdvCategorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AdvCategorie>
 *
 * @method AdvCategorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdvCategorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdvCategorie[]    findAll()
 * @method AdvCategorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvCategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdvCategorie::class);
    }

//    /**
//     * @return AdvCategorie[] Returns an array of AdvCategorie objects
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

//    public function findOneBySomeField($value): ?AdvCategorie
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
