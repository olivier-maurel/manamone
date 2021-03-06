<?php

namespace App\Repository\App;

use App\Entity\App\Envelope;
use App\Entity\App\Project;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Envelope|null find($id, $lockMode = null, $lockVersion = null)
 * @method Envelope|null findOneBy(array $criteria, array $orderBy = null)
 * @method Envelope[]    findAll()
 * @method Envelope[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnvelopeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Envelope::class);
    }

    public function countAll(Project $project)
    {
        return $this->createQueryBuilder('e')
            ->select('COUNT(e)')
            ->where('e.project = :project')
            ->setParameter('project', $project)
            ->getQuery()
            ->setMaxResults(1)
            ->getSingleScalarResult()
        ;
    }

    // /**
    //  * @return Envelope[] Returns an array of Envelope objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Envelope
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
