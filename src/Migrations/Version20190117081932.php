<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190117081932 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Creates relation between pokemon species and from which evolves from';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pokemon_species ADD evolves_from_species_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pokemon_species ADD CONSTRAINT FK_C9658B837D11D524 FOREIGN KEY (evolves_from_species_id) REFERENCES pokemon_species (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C9658B837D11D524 ON pokemon_species (evolves_from_species_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pokemon_species DROP FOREIGN KEY FK_C9658B837D11D524');
        $this->addSql('DROP INDEX UNIQ_C9658B837D11D524 ON pokemon_species');
        $this->addSql('ALTER TABLE pokemon_species DROP evolves_from_species_id');
    }
}
