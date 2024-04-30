<?php

namespace App\Repository;

use App\Entity\AdvPays;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AdvPays>
 *
 * @method AdvPays|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdvPays|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdvPays[]    findAll()
 * @method AdvPays[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvPaysRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdvPays::class);
    }

//    /**
//     * @return AdvPays[] Returns an array of AdvPays objects
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

//    public function findOneBySomeField($value): ?AdvPays
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
