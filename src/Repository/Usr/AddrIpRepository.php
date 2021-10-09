<?php

namespace App\Repository\Usr;

use App\Entity\Usr\AddrIp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AddrIp|null find($id, $lockMode = null, $lockVersion = null)
 * @method AddrIp|null findOneBy(array $criteria, array $orderBy = null)
 * @method AddrIp[]    findAll()
 * @method AddrIp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AddrIpRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AddrIp::class);
    }

    // /**
    //  * @return AddrIp[] Returns an array of AddrIp objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AddrIp
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
