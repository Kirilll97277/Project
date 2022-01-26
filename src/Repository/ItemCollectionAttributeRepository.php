<?php

namespace App\Repository;

use App\Entity\CollectionAttribute;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CollectionAttribute|null find($id, $lockMode = null, $lockVersion = null)
 * @method CollectionAttribute|null findOneBy(array $criteria, array $orderBy = null)
 * @method CollectionAttribute[]    findAll()
 * @method CollectionAttribute[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemCollectionAttributeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CollectionAttribute::class);
    }

    // /**
    //  * @return ItemCollectionAttribute[] Returns an array of ItemCollectionAttribute objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ItemCollectionAttribute
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
