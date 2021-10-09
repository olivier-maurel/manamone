<?php

namespace App\Repository\App;

use App\Entity\App\RowFactual;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RowFactual|null find($id, $lockMode = null, $lockVersion = null)
 * @method RowFactual|null findOneBy(array $criteria, array $orderBy = null)
 * @method RowFactual[]    findAll()
 * @method RowFactual[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RowFactualRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RowFactual::class);
    }

    // /**
    //  * @return RowFactual[] Returns an array of RowFactual objects
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
    public function findOneBySomeField($value): ?RowFactual
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
