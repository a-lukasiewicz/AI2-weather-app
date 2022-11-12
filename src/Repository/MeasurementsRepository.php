<?php

namespace App\Repository;

use App\Entity\Location;
use App\Entity\Measurements;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Measurements>
 *
 * @method Measurements|null find($id, $lockMode = null, $lockVersion = null)
 * @method Measurements|null findOneBy(array $criteria, array $orderBy = null)
 * @method Measurements[]    findAll()
 * @method Measurements[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MeasurementsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Measurements::class);
    }

    public function findByLocation($location)
    {
        $var = $this->createQueryBuilder('weather');
        $var->where('weather.id = :location')
            ->setParameter('location', $location);
        return $var->getQuery()->getResult();
    }


    public function save(Measurements $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Measurements $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
