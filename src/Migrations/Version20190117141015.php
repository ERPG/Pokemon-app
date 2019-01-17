<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190117141015 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Fixes evolutions (self-relation on Pokémon Species)';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pokemon_species DROP INDEX UNIQ_C9658B837D11D524, ADD INDEX IDX_C9658B837D11D524 (evolves_from_species_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pokemon_species DROP INDEX IDX_C9658B837D11D524, ADD UNIQUE INDEX UNIQ_C9658B837D11D524 (evolves_from_species_id)');
    }
}
