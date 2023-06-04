<?php

namespace App\Repository;

use App\Entity\EquipementInterieur;
use App\Entity\Gite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\Query\Expr;
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

        if (isset($options['nbChambres'])) {
            $queryBuilder->andWhere('g.nbChambres = :nbChambres')
                ->setParameter('nbChambres', $options['nbChambres']);
        }
        if (isset($options['acceptAnimaux']) && $options['acceptAnimaux'] === true) {
            $queryBuilder->andWhere('g.acceptAnimaux = :acceptAnimaux')
                ->setParameter('acceptAnimaux', $options['acceptAnimaux']);
        }
        if (isset($options['ville']) && $options['ville'] !== null) {

            if (isset($options['extendToDepartement']) && $options['extendToDepartement'] === true) {

                $queryBuilder->join('g.ville', 'v')
                    ->join('v.departement', 'd')
                    ->andWhere('d.id = :departementIdDeVille')
                    ->setParameter('departementIdDeVille', $options['ville']->getDepartement()->getId());
                // dd($options['ville']->getDepartement()->getId());
            } else if ((isset($options['extendToRegion']) && $options['extendToRegion'] === true)) {
                $queryBuilder->join('g.ville', 'v')
                    ->join('v.departement', 'd')
                    ->join('d.region', 'r')
                    ->andWhere('r.id = :regionIdDeDepartement')
                    ->setParameter('regionIdDeDepartement', $options['ville']->getDepartement()->getRegion()->getId());
            } else {


                $queryBuilder->andWhere('g.ville = :ville')
                    ->setParameter('ville', $options['ville']);
            }
        }
        if (isset($options['equipementInterieur'])) {
            $equipementsI = $options['equipementInterieur'];

            foreach ($equipementsI as $index => $equipementI) {
                $idEquipementI = [];
                $idEquipementI['adresse'] = 'ei' . $index;
                $idEquipementI['id'] = $equipementI->getId();

                $queryBuilder->join('g.equipementInterieur', $idEquipementI['adresse'])
                    ->andWhere("{$idEquipementI['adresse']}.id = {$idEquipementI['id']}");
            }
        }
        if (isset($options['equipementExterieur'])) {
            $equipementsE = $options['equipementExterieur'];

            foreach ($equipementsE as $index => $equipementE) {
                $idEquipementE = [];
                $idEquipementE['adresse'] = 'ee' . $index;
                $idEquipementE['id'] = $equipementE->getId();

                $queryBuilder->join('g.equipementExterieur', $idEquipementE['adresse'])
                    ->andWhere("{$idEquipementE['adresse']}.id = {$idEquipementE['id']}");
            }
        }
        if (isset($options['service'])) {
            $services = $options['service'];

            foreach ($services as $index => $service) {
                $idService = [];
                $idService['adresse'] = 's' . $index;
                $idService['id'] = $service->getId();

                $queryBuilder->join('g.service', $idService['adresse'])
                    ->andWhere("{$idService['adresse']}.id = {$idService['id']}");
            }
        };
        return $queryBuilder->getQuery()->getResult();
    }

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
