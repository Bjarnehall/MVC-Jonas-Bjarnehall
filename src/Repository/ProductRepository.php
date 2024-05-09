<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }
/**
 * @return Product[]
 */
    public function findByMinimumValue(int $value): array
    {
        return $this->createQueryBuilder('p')
        ->andWhere('p.value >= :value')
        ->setParameter('value', $value)
        ->orderBy('p.value', 'ASC')
        ->getQuery()
        ->getResult()
        ;
    }

    /**
    * @param int $value
    * @return Product[] Returns an array of Product objects
    */
    public function findByMinimumValue2(int $value): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT * FROM product AS p
            WHERE p.value >= :value
            ORDER BY p.value ASC
            ';

        $resultSet = $conn->executeQuery($sql, ['value' => $value]);
/** @phpstan-ignore-next-line */
        return $resultSet->fetchAllAssociative();
        // return $query->getResult();
    }

    //    /**
    //     * @return Product[] Returns an array of Product objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Product
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
