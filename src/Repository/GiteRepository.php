<?php

namespace App\Repository;

use App\Entity\EquipementInterieur;
use App\Entity\Gite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Gite>
 *
 * @method Gite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gite[]    findAll()
 * @method Gite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gite::class);
    }

    public function save(Gite $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Gite $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findGiteById(int $id)
    {
        return $this->createQueryBuilder('g')
            ->where('g.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findGiteByOptions(array $options)
    {
        $queryBuilder = $this->createQueryBuilder('g');
        // dd($options);
        if (isset($options['nbChambres'])) {
            $queryBuilder->andWhere('g.nbChambres = :nbChambres')
                ->setParameter('nbChambres', $options['nbChambres']);
        }
        if (isset($options['acceptAnimaux']) && $options['acceptAnimaux'] === true) {
            $queryBuilder->andWhere('g.acceptAnimaux = :acceptAnimaux')
                ->setParameter('acceptAnimaux', $options['acceptAnimaux']);
        }
        if (isset($options['ville']) && $options['ville'] !== null) {
            $queryBuilder->andWhere('g.ville = :ville')
                ->setParameter('ville', $options['ville']);
        }
        if (isset($options['equipementInterieur'])) {
            $equipementsI = $options['equipementInterieur'];
            // dd($equipementsI);
            $queryBuilder->join('g.equipementInterieur', 'ei');
            foreach ($equipementsI as $equipementI) {
                $queryBuilder->andWhere('ei.nom = :nomEquipementI')
                    ->setParameter('nomEquipementI', $equipementI->getNom());
            }
        }
        if (isset($options['equipementExterieur'])) {
            $equipementsE = $options['equipementExterieur'];
            // dd($equipementsE);
            $queryBuilder->join('g.equipementExterieur', 'ee');
            $equipementEList = [];

            foreach ($equipementsE as $index => $equipementE) {
                $nomEquipementE = [];
                $nomEquipementE['index'] = 'EquipementE_' . $index;
                $nomEquipementE['nom'] = $equipementE->getnom();

                $queryBuilder->andWhere("ee.nom = :{$nomEquipementE['index']}")
                    ->setParameter($nomEquipementE['index'], $nomEquipementE['nom']);

                $equipementEList[] = $nomEquipementE;
                // $nameEquipE = 'equipementExterieur_' . $index;
                // dump($index, $equipementE, $nomEquipementE, 'EquipementEList', $equipementEList);
            }
            // $queryBuilder->andWhere('ee.nom = :nomEquipementE')
            //     ->setParameter('nomEquipementE', $equipementEList['nom']);
        }
        if (isset($options['service']) && $options['service'] !== null) {
            $queryBuilder->join('g.service', 's');
            foreach ($options['service'] as $index => $service) {
                $nomService = 'service_' . $index;
                $queryBuilder->andWhere('s.nom = :' . $service)
                    ->setParameter($nomService, $service->getNom());
            }
        };


        // dd($queryBuilder);
        return $queryBuilder->getQuery()->getResult();
    }

    // public function findGiteByOptions(array $options)
    // {
    //     $queryBuilder = $this->createQueryBuilder('g');

    //     foreach ($options as $key => $value) {
    //         if ($key === 'equipementInterieur') {
    //             $queryBuilder->innerJoin('g.equipementInterieur', 'ei');
    //         }
    //         if ($value !== null) {
    //             $queryBuilder->andWhere("g.$key = :$key")
    //                 ->setParameter($key, $value);
    //         }
    //     }

    //     return $queryBuilder->getQuery()->getResult();
    // }

    public function findAllInsideEquipmentsForAGiteByGiteId(int $id)
    {
        return $this->createQueryBuilder('g')
            ->where('g.id = :id')
            ->setParameter('id', $id)
            ->innerJoin('g.equipementInterieur', 'ei')
            ->addSelect('ei')
            ->getQuery()
            ->getResult();
    }

    public function findAllOutsideEquipmentsForAGiteByGiteId(int $id)
    {
        return $this->createQueryBuilder('g')
            ->where('g.id = :id')
            ->setParameter('id', $id)
            ->innerJoin('g.equipementExterieur', 'ee')
            ->addSelect('ee')
            ->getQuery()
            ->getResult();
    }

    public function findAllServicesForAGiteByGiteId(int $id)
    {
        return $this->createQueryBuilder('g')
            ->where('g.id = :id')
            ->setParameter('id', $id)
            ->innerJoin('g.service', 's')
            ->addSelect('s')
            ->getQuery()
            ->getResult();
    }


    //    /**
    //     * @return Gite[] Returns an array of Gite objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('g.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Gite
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
