<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190117080403 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Creates Pokemon Species table';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pokemon_species (id INT NOT NULL, identifier VARCHAR(255) NOT NULL, gender_rate INT NOT NULL, capture_rate INT NOT NULL, base_happiness INT NOT NULL, is_baby TINYINT(1) NOT NULL, hatch_counter INT NOT NULL, has_gender_differences TINYINT(1) NOT NULL, forms_switchable TINYINT(1) NOT NULL, conquest_order INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE pokemon_species');
    }
}
