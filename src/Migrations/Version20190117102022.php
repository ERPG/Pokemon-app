<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190117102022 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Added relation between Pokémon Species and Pokémon Habitat';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pokemon_species ADD habitat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pokemon_species ADD CONSTRAINT FK_C9658B83AFFE2D26 FOREIGN KEY (habitat_id) REFERENCES pokemon_habitat (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C9658B83AFFE2D26 ON pokemon_species (habitat_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pokemon_species DROP FOREIGN KEY FK_C9658B83AFFE2D26');
        $this->addSql('DROP INDEX UNIQ_C9658B83AFFE2D26 ON pokemon_species');
        $this->addSql('ALTER TABLE pokemon_species DROP habitat_id');
    }
}
