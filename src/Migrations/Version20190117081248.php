<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190117081248 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Add relation between pokemon and pokemon species';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pokemon ADD species_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pokemon ADD CONSTRAINT FK_62DC90F3B2A1D860 FOREIGN KEY (species_id) REFERENCES pokemon_species (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_62DC90F3B2A1D860 ON pokemon (species_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pokemon DROP FOREIGN KEY FK_62DC90F3B2A1D860');
        $this->addSql('DROP INDEX UNIQ_62DC90F3B2A1D860 ON pokemon');
        $this->addSql('ALTER TABLE pokemon DROP species_id');
    }
}
