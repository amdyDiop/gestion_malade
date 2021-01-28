<?php

namespace App\Repository;

use App\Entity\Patient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Patient|null find($id, $lockMode = null, $lockVersion = null)
 * @method Patient|null findOneBy(array $criteria, array $orderBy = null)
 * @method Patient[]    findAll()
 * @method Patient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Patient::class);
    }

    public function patientSearch($valeur)
    {
        $qb = $this->createQueryBuilder('p')
            ->join('p.user', 'u')
            ->andWhere('u.roles  =:role')
            ->orWhere('u.prenom LIKE :prenom')
            ->orWhere('u.cni LIKE :cni')
            ->orWhere('u.nom LIKE :nom')
            ->setParameter('role', 'ROLE_PATIENT')
            ->setParameter('prenom', '%' . $valeur . '%')
            ->setParameter('cni', '%' . $valeur . '%')
            ->setParameter('nom', '%' . $valeur . '%');
        return $qb->getQuery()->execute();
    }
}
