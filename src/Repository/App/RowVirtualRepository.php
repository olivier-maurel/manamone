<?php

namespace App\Repository\App;

use App\Entity\App\RowVirtual;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RowVirtual|null find($id, $lockMode = null, $lockVersion = null)
 * @method RowVirtual|null findOneBy(array $criteria, array $orderBy = null)
 * @method RowVirtual[]    findAll()
 * @method RowVirtual[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RowVirtualRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RowVirtual::class);
    }

    // /**
    //  * @return RowVirtual[] Returns an array of RowVirtual objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RowVirtual
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
