<?php

namespace App\Repository\App;

use App\Entity\App\Frequency;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Frequency|null find($id, $lockMode = null, $lockVersion = null)
 * @method Frequency|null findOneBy(array $criteria, array $orderBy = null)
 * @method Frequency[]    findAll()
 * @method Frequency[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FrequencyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Frequency::class);
    }

    // /**
    //  * @return Frequency[] Returns an array of Frequency objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Frequency
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
