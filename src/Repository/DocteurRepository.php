<?php

namespace App\Repository;

use App\Entity\Docteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Docteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Docteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Docteur[]    findAll()
 * @method Docteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Docteur::class);
    }

    public function findByEmail($email)
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT d
        FROM App\Entity\Docteur d
        JOIN d.user u
        WHERE u.email =:email'
        )->setParameter('email', $email);
        return $query->getResult();
    }
}
