<?php

namespace App\Repository;

use App\Entity\StreetFood;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StreetFood|null find($id, $lockMode = null, $lockVersion = null)
 * @method StreetFood|null findOneBy(array $criteria, array $orderBy = null)
 * @method StreetFood[]    findAll()
 * @method StreetFood[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StreetFoodRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StreetFood::class);
    }

    // /**
    //  * @return StreetFood[] Returns an array of StreetFood objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StreetFood
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
