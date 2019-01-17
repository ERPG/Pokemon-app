<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PokemonSpeciesRepository")
 * @ORM\Table(name="pokemon_species")
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
 */
class Species
{
    /**
     * @var int
     * 
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=255)
     */
    private $identifier;

    /**
     * @var int
     * 
     * @ORM\Column(type="integer", name="gender_rate")
     */
    private $genderRate;

    /**
     * @var int
     * 
     * @ORM\Column(type="integer", name="capture_rate")
     */
    private $captureRate;

    /**
     * @var int
     * 
     * @ORM\Column(type="integer", name="base_happiness")
     */
    private $baseHappiness;

    /**
     * @var bool
     * 
     * @ORM\Column(type="boolean", name="is_baby")
     */
    private $isBaby;

    /**
     * @var int
     * 
     * @ORM\Column(type="integer", name="hatch_counter")
     */
    private $hatchCounter;

    /**
     * @var bool
     * 
     * @ORM\Column(type="boolean", name="has_gender_differences")
     */
    private $hasGenderDifferences;

    /**
     * @var bool
     * 
     * @ORM\Column(type="boolean", name="forms_switchable")
     */
    private $formsSwitchable;

    /**
     * @var int
     * 
     * @ORM\Column(type="integer", nullable=true, name="conquest_order")
     */
    private $conquestOrder;

    /**
     * @var Species[]
     * 
     * @ORM\OneToMany(targetEntity="Species", mappedBy="evolvesFrom")
     */
    private $evolutions;

    /**
     * @var Species
     * 
     * @ORM\ManyToOne(targetEntity="Species", inversedBy="evolutions")
     * @ORM\JoinColumn(name="evolves_from_species_id", referencedColumnName="id")
     */
    private $evolvesFrom;

    /**
     * @var Habitat
     * 
     * @ORM\ManyToOne(targetEntity="Habitat", inversedBy="species")
     * @ORM\JoinColumn(name="habitat_id", referencedColumnName="id")
     */
    private $habitat;

    /**
     * @var Pokemon
     * 
     * @ORM\OneToMany(targetEntity="Pokemon", mappedBy="species")
     */
    private $pokemons;

    public function __construct()
    {
        $this->evolutions = new ArrayCollection();
        $this->pokemons = new ArrayCollection();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function getGenderRate(): int
    {
        return $this->genderRate;
    }

    public function getCaptureRate(): int
    {
        return $this->captureRate;
    }

    public function getBaseHappiness(): int
    {
        return $this->baseHappiness;
    }

    public function isBaby(): bool
    {
        return $this->isBaby;
    }

    public function getHatchCounter(): int
    {
        return $this->hatchCounter;
    }

    public function hasGenderDifferences(): bool
    {
        return $this->hasGenderDifferences;
    }

    public function isFormsSwitchable(): bool
    {
        return $this->formsSwitchable;
    }

    public function getConquestOrder(): ?int
    {
        return $this->conquestOrder;
    }

    public function getHabitat(): ?Habitat
    {
        return $this->habitat;
    }

    /**
     * @return Collection|Species[]
     */
    public function getEvolutions(): Collection
    {
        return $this->evolutions;
    }

    public function addEvolution(Species $evolution): self
    {
        if (!$this->evolutions->contains($evolution)) {
            $this->evolutions[] = $evolution;
            $evolution->evolvesFrom($this);
        }

        return $this;
    }

    public function removeEvolution(Species $evolution): self
    {
        if ($this->evolutions->contains($evolution)) {
            $this->evolutions->removeElement($evolution);
            // set the owning side to null (unless already changed)
            if ($evolution->getEvolvesFrom() === $this) {
                $evolution->evolvesFrom(null);
            }
        }

        return $this;
    }

    public function getEvolvesFrom(): ?self
    {
        return $this->evolvesFrom;
    }

    public function evolvesFrom(?self $evolvesFrom): self
    {
        $this->evolvesFrom = $evolvesFrom;

        return $this;
    }

    public function addPokemon(Pokemon $pokemon): self
    {
        if (!$this->pokemons->contains($pokemon)) {
            $this->pokemons[] = $pokemon;
            $pokemon->setSpecies($this);
        }

        return $this;
    }

    public function removePokemon(Pokemon $pokemon): self
    {
        if ($this->pokemons->contains($pokemon)) {
            $this->pokemons->removeElement($pokemon);
            // set the owning side to null (unless already changed)
            if ($pokemon->getSpecies() === $this) {
                $pokemon->setSpecies(null);
            }
        }

        return $this;
    }

    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function setGenderRate(int $genderRate): self
    {
        $this->genderRate = $genderRate;

        return $this;
    }

    public function setCaptureRate(int $captureRate): self
    {
        $this->captureRate = $captureRate;

        return $this;
    }

    public function setBaseHappiness(int $baseHappiness): self
    {
        $this->baseHappiness = $baseHappiness;

        return $this;
    }

    public function getIsBaby(): ?bool
    {
        return $this->isBaby;
    }

    public function setIsBaby(bool $isBaby): self
    {
        $this->isBaby = $isBaby;

        return $this;
    }

    public function setHatchCounter(int $hatchCounter): self
    {
        $this->hatchCounter = $hatchCounter;

        return $this;
    }

    public function getHasGenderDifferences(): ?bool
    {
        return $this->hasGenderDifferences;
    }

    public function setHasGenderDifferences(bool $hasGenderDifferences): self
    {
        $this->hasGenderDifferences = $hasGenderDifferences;

        return $this;
    }

    public function getFormsSwitchable(): ?bool
    {
        return $this->formsSwitchable;
    }

    public function setFormsSwitchable(bool $formsSwitchable): self
    {
        $this->formsSwitchable = $formsSwitchable;

        return $this;
    }

    public function setConquestOrder(?int $conquestOrder): self
    {
        $this->conquestOrder = $conquestOrder;

        return $this;
    }

    public function setEvolvesFrom(?self $evolvesFrom): self
    {
        $this->evolvesFrom = $evolvesFrom;

        return $this;
    }

    public function setHabitat(?Habitat $habitat): self
    {
        $this->habitat = $habitat;

        return $this;
    }

    /**
     * @return Collection|Pokemon[]
     */
    public function getPokemons(): Collection
    {
        return $this->pokemons;
    }
}
