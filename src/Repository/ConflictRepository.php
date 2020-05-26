<?php

namespace App\Repository;

use App\Entity\Conflict;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Conflict|null find($id, $lockMode = null, $lockVersion = null)
 * @method Conflict|null findOneBy(array $criteria, array $orderBy = null)
 * @method Conflict[]    findAll()
 * @method Conflict[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConflictRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Conflict::class);
    }

    // /**
    //  * @return Conflict[] Returns an array of Conflict objects
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
    public function findOneBySomeField($value): ?Conflict
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
