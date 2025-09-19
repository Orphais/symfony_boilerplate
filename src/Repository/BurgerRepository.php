<?php

namespace App\Repository;

use App\Entity\Burger;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Burger>
 */
class BurgerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Burger::class);
    }

    //    /**
    //     * @return Burger[] Returns an array of Burger objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Burger
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function findWithOignons(): array
    {
        return $this->createQueryBuilder('b')
            ->join('b.oignon', 'o')
            ->groupBy('b.id')
            ->getQuery()
            ->getResult();
    }

    public function findBurgerWithIngredient($ingredient): array
    {
        return $this->createQueryBuilder('b')
            ->leftJoin('b.oignon', 'o')
            ->leftJoin('b.sauce', 's')
            ->leftJoin('b.pain', 'p')
            ->andWhere('o.name LIKE :ingredient OR s.name LIKE :ingredient OR p.name LIKE :ingredient')
            ->setParameter('ingredient', '%' . $ingredient . '%')
            ->groupBy('b.id')
            ->getQuery()
            ->getResult();
    }

    public function findTopXBurgers(int $limit): array
    {
        return $this->createQueryBuilder('b')
            ->orderBy('b.price', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

}
