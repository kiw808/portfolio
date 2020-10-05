<?php

namespace App\Repository;

use App\Entity\TechnologyType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TechnologyType|null find($id, $lockMode = null, $lockVersion = null)
 * @method TechnologyType|null findOneBy(array $criteria, array $orderBy = null)
 * @method TechnologyType[]    findAll()
 * @method TechnologyType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TechnologyTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TechnologyType::class);
    }

    // /**
    //  * @return TechnologyType[] Returns an array of TechnologyType objects
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
    public function findOneBySomeField($value): ?TechnologyType
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
