<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Habitat;
use App\Entity\Species;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

final class PokemonSpeciesFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $handler = fopen(__DIR__ . '/pokemon_species.csv', 'rb');

        if (!$handler) {
            throw new \RuntimeException('Something went wrong while opening pokemon_species.csv');
        }

        $keys = fgetcsv($handler); // Header

        while ($data = fgetcsv($handler)) {
            $data = array_combine($keys, $data);

            $species = (new Species())
                ->setId((int)$data['id'])
                ->setIdentifier($data['identifier'])
                ->setGenderRate((int)$data['gender_rate'])
                ->setCaptureRate((int)$data['capture_rate'])
                ->setBaseHappiness((int)$data['base_happiness'])
                ->setIsBaby((bool)$data['is_baby'])
                ->setHatchCounter((int)$data['hatch_counter'])
                ->setHasGenderDifferences((bool)$data['has_gender_differences'])
                ->setFormsSwitchable((bool)$data['forms_switchable'])
                ->setConquestOrder((int)$data['conquest_order'])
            ;

            if (isset($data['evolves_from_species_id']) && $this->hasReference('species_' . $data['evolves_from_species_id'])) {
                /** @var Species $baseSpecies */
                $baseSpecies = $this->getReference('species_' . $data['evolves_from_species_id']);
                $baseSpecies->addEvolution($species);
            }

            if (isset($data['habitat_id']) && $this->hasReference('habitat_' . $data['habitat_id'])) {
                /** @var Habitat $habitat */
                $habitat = $this->getReference('habitat_' . $data['habitat_id']);
                $habitat->addSpecies($species);
            }
            
            $manager->persist($species);
            $manager->flush();
            $this->addReference('species_' . $data['id'], $species);
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
            PokemonHabitatsFixtures::class
        ];
    }
}