<?php

namespace App\Repository\App;

use App\Entity\App\CategoryTemplate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategoryTemplate|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryTemplate|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryTemplate[]    findAll()
 * @method CategoryTemplate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryTemplateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryTemplate::class);
    }

    // /**
    //  * @return CategoryTemplate[] Returns an array of CategoryTemplate objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CategoryTemplate
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
