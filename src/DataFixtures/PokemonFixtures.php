<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Pokemon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

final class PokemonFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $handler = fopen(__DIR__ . '/pokemon.csv', 'rb');

        if (!$handler) {
            throw new \RuntimeException('Something went wrong while opening pokemon.csv');
        }

        $keys = fgetcsv($handler); // Header

        while ($data = fgetcsv($handler)) {
            $data = array_combine($keys, $data);
            $pokemon = (new Pokemon())
                ->setId((int)$data['id'])
                ->setIdentifier($data['identifier'])
                ->setHeight((int)$data['height'])
                ->setWeight((int)$data['weight'])
                ->setBaseExperience((int)$data['base_experience'])
                ->setIsDefault((bool)$data['is_default'])
            ;
            
            $this->getReference('species_' . $data['species_id'])->addPokemon($pokemon);
            
            $manager->persist($pokemon);
            $manager->flush();
        }
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            PokemonSpeciesFixtures::class
        ];
    }
}