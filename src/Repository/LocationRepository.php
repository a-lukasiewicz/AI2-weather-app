<?php

namespace App\Repository;

use App\Entity\Location;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Location>
 *
 * @method Location|null find($id, $lockMode = null, $lockVersion = null)
 * @method Location|null findOneBy(array $criteria, array $orderBy = null)
 * @method Location[]    findAll()
 * @method Location[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Location::class);
    }

    public function save(Location $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Location $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByLocation($location)
    {
        $qb = $this->createQueryBuilder('m');
        $qb->where('m.city = :location')
            ->setParameter('location', $location);
        return $qb->getQuery()->getResult();
    }

    public function findByCountryAndCity($city, $country): ?Location
    {
        $qb = $this->createQueryBuilder('l');
        $qb->where('l.country = :country')
            ->andWhere('l.city = :city')
            ->setParameter('country', $country)
            ->setParameter('city', $city);
        $query = $qb->getQuery();
        $result = $query->getOneOrNullResult();

        return $result;
    }
}
