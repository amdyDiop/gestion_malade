<?php

namespace App\Repository;

use App\Entity\Infirmier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Infirmier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Infirmier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Infirmier[]    findAll()
 * @method Infirmier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfirmierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Infirmier::class);
    }

     /**
      * @return Infirmier[] Returns an array of Infirmier objects
      */

    public function findByUserId($email)
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT i
        FROM App\Entity\Infirmier i
        JOIN i.user u
        WHERE u.email =:email'
        )->setParameter('email', $email);
        return $query->getResult();
    }


    /*
    public function findOneBySomeField($value): ?Infirmier
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
