<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Habitat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

final class PokemonHabitatsFixtures extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $handler = fopen(__DIR__ . '/pokemon_habitats.csv', 'rb');

        if (!$handler) {
            throw new \RuntimeException('Something went wrong while opening pokemon_habitats.csv');
        }

        $keys = fgetcsv($handler); // Header

        while ($data = fgetcsv($handler)) {
            $data = array_combine($keys, $data);
            $habitat = (new Habitat())
                ->setId((int)$data['id'])
                ->setIdentifier($data['identifier'])
            ;
            
            $manager->persist($habitat);
            $manager->flush();
            $this->addReference('habitat_' . $data['id'], $habitat);
        }
    }
}