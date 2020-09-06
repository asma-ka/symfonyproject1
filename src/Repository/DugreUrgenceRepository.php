<?php

namespace App\Repository;

use App\Entity\DugreUrgence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DugreUrgence|null find($id, $lockMode = null, $lockVersion = null)
 * @method DugreUrgence|null findOneBy(array $criteria, array $orderBy = null)
 * @method DugreUrgence[]    findAll()
 * @method DugreUrgence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DugreUrgenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DugreUrgence::class);
    }

    // /**
    //  * @return DugreUrgence[] Returns an array of DugreUrgence objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DugreUrgence
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
