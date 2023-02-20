<?php

namespace App\Repository;

use App\Entity\PerformanceC;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PerformanceC>
 *
 * @method PerformanceC|null find($id, $lockMode = null, $lockVersion = null)
 * @method PerformanceC|null findOneBy(array $criteria, array $orderBy = null)
 * @method PerformanceC[]    findAll()
 * @method PerformanceC[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PerformanceCRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PerformanceC::class);
    }

    public function save(PerformanceC $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PerformanceC $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByCompetition($competition){

        $qb= $this->createQueryBuilder('p');
        $qb ->where('p.competitionP=:comp');
        $qb->setParameters(['comp'=>$competition]);
        return $qb->getQuery()->getResult();}
    


//    /**
//     * @return PerformanceC[] Returns an array of PerformanceC objects
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

//    public function findOneBySomeField($value): ?PerformanceC
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
