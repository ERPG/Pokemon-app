<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190117152451 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Fixes relation between Pokémon and Pokémon species';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pokemon DROP INDEX UNIQ_62DC90F3B2A1D860, ADD INDEX IDX_62DC90F3B2A1D860 (species_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pokemon DROP INDEX IDX_62DC90F3B2A1D860, ADD UNIQUE INDEX UNIQ_62DC90F3B2A1D860 (species_id)');
    }
}
