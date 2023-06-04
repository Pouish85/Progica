<?php

namespace App\Repository;

use App\Entity\Prix;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Prix>
 *
 * @method Prix|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prix|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prix[]    findAll()
 * @method Prix[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrixRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Prix::class);
    }

    public function save(Prix $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Prix $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findPriceForAGiteId($giteId)
    {
        return $this->createQueryBuilder('p')
            ->where('p.id = :giteId')
            ->setParameter('giteId', $giteId)
            ->getQuery()
            ->getOneOrNullResult();
    }


    public function findPriceByDate(DateTime $dateDebut)
    {
        return $this->createQueryBuilder('p')
            ->where(':dateDebut BETWEEN p.debut AND p.fin')
            ->setParameter('dateDebut', $dateDebut)
            ->getQuery()
            ->getOneOrNullResult();
    }
    //    /**
    //     * @return Prix[] Returns an array of Prix objects
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

    //    public function findOneBySomeField($value): ?Prix
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
