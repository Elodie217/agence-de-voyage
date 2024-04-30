<?php

namespace App\Repository;

use App\Entity\AdvRole;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AdvRole>
 *
 * @method AdvRole|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdvRole|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdvRole[]    findAll()
 * @method AdvRole[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvRoleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdvRole::class);
    }

//    /**
//     * @return AdvRole[] Returns an array of AdvRole objects
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

//    public function findOneBySomeField($value): ?AdvRole
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
