<?php

namespace App\Repository\App;

use App\Entity\App\Account;
use App\Entity\Usr\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Account|null find($id, $lockMode = null, $lockVersion = null)
 * @method Account|null findOneBy(array $criteria, array $orderBy = null)
 * @method Account[]    findAll()
 * @method Account[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccountRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Account::class);
    }

    public function countAll(User $user)
    {
        return $this->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->where('p.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->setMaxResults(1)
            ->getSingleScalarResult()
        ;
    }

    public function findOtherAccount(Account $account, User $user)
    {
        return $this->createQueryBuilder('a')
            ->where('a.id != :account')
            ->andWhere('a.user = :user')
            ->setParameter('account', $account)
            ->setParameter('user', $user)
            ->orderBy('a.created_at', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
