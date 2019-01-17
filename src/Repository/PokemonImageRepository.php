<?php

namespace App\Repository;

use App\Entity\PokemonImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PokemonImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method PokemonImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method PokemonImage[]    findAll()
 * @method PokemonImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PokemonImageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PokemonImage::class);
    }

    // /**
    //  * @return PokemonImage[] Returns an array of PokemonImage objects
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
    public function findOneBySomeField($value): ?PokemonImage
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
