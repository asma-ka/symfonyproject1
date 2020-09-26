<?php

namespace App\Repository;

use App\Entity\TypeLigne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeLigne|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeLigne|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeLigne[]    findAll()
 * @method TypeLigne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeLigneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeLigne::class);
    }

    // /**
    //  * @return TypeLigne[] Returns an array of TypeLigne objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeLigne
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
