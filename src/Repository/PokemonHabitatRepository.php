<?php

namespace App\Repository;

use App\Entity\Habitat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Habitat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Habitat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Habitat[]    findAll()
 * @method Habitat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PokemonHabitatRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Habitat::class);
    }

    // /**
    //  * @return PokemonHabitat[] Returns an array of PokemonHabitat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PokemonHabitat
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
