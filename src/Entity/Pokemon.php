<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PokemonRepository")
 * @ApiResource()
 */
class Pokemon
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
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @ORM\Column(type="string", length=255)
     */
    private $identifier;

    /**
     * @var int
     * 
     * @Assert\NotBlank
     * @Assert\Type("int")
     * @Assert\GreaterThan(0)
     * @ORM\Column(type="integer")
     */
    private $height;

    /**
     * @var int
     * 
     * @Assert\NotBlank
     * @Assert\Type("int")
     * @Assert\GreaterThan(0)
     * @ORM\Column(type="integer")
     */
    private $weight;

    /**
     * @var int
     * 
     * @Assert\NotBlank
     * @Assert\Type("integer")
     * @Assert\GreaterThanOrEqual(0)
     * @ORM\Column(type="integer", name="base_experience")
     */
    private $baseExperience;

    /**
     * @var bool
     * 
     * @Assert\NotNull
     * @Assert\Type("bool")
     * @ORM\Column(type="boolean", name="is_default")
     */
    private $isDefault;

    /**
     * @var Species
     * 
     * @ORM\ManyToOne(targetEntity="Species", inversedBy="pokemons")
     * @ORM\JoinColumn(name="species_id", referencedColumnName="id")
     */
    private $species;
    
    public function getId(): int
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

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function getBaseExperience(): int
    {
        return $this->baseExperience;
    }

    public function getSpecies(): Species
    {
        return $this->species;
    }

    public function setSpecies(Species $species): void
    {
        $this->species = $species;
    }

    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function setBaseExperience(int $baseExperience): self
    {
        $this->baseExperience = $baseExperience;

        return $this;
    }

    public function getIsDefault(): ?bool
    {
        return $this->isDefault;
    }

    public function setIsDefault(bool $isDefault): self
    {
        $this->isDefault = $isDefault;

        return $this;
    }
}
