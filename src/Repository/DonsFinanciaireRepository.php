<?php

namespace App\Repository;

use App\Entity\DonsFinanciaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DonsFinanciaire>
 *
 * @method DonsFinanciaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method DonsFinanciaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method DonsFinanciaire[]    findAll()
 * @method DonsFinanciaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DonsFinanciaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DonsFinanciaire::class);
    }

//    /**
//     * @return DonsFinanciaire[] Returns an array of DonsFinanciaire objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DonsFinanciaire
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
