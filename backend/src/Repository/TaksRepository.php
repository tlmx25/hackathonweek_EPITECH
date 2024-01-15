<?php

namespace App\Repository;

use App\Entity\Taks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Taks>
 *
 * @method Taks|null find($id, $lockMode = null, $lockVersion = null)
 * @method Taks|null findOneBy(array $criteria, array $orderBy = null)
 * @method Taks[]    findAll()
 * @method Taks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Taks::class);
    }

//    /**
//     * @return Taks[] Returns an array of Taks objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Taks
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
