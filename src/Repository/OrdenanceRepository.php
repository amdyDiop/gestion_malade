<?php

namespace App\Repository;

use App\Entity\Ordenance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ordenance|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ordenance|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ordenance[]    findAll()
 * @method Ordenance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdenanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ordenance::class);
    }

    // /**
    //  * @return Ordenance[] Returns an array of Ordenance objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ordenance
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
