<?php

namespace App\Repository\App;

use App\Entity\App\Project;
use App\Entity\Usr\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\AbstractQuery;

/**
 * @method Project|null find($id, $lockMode = null, $lockVersion = null)
 * @method Project|null findOneBy(array $criteria, array $orderBy = null)
 * @method Project[]    findAll()
 * @method Project[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }

    public function countAll(User $user)
    {
        return $this->createQueryBuilder('p')
            ->select('COUNT(p)')
            ->where('p.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->setMaxResults(1)
            ->getSingleScalarResult()
        ;
    }

    public function findOtherProject(Project $project, User $user)
    {
        return $this->createQueryBuilder('p')
            ->where('p.id != :project')
            ->andWhere('p.user = :user')
            ->setParameter('project', $project)
            ->setParameter('user', $user)
            ->orderBy('p.created_at', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    // /**
    //  * @return Project[] Returns an array of Project objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Project
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
