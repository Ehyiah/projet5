<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180630102826 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE element_collection CHANGE region region VARCHAR(255) DEFAULT NULL, CHANGE publisher publisher VARCHAR(255) DEFAULT NULL, CHANGE etat etat VARCHAR(255) DEFAULT NULL, CHANGE buy_price buy_price DOUBLE PRECISION DEFAULT NULL, CHANGE support support VARCHAR(255) DEFAULT NULL, CHANGE player_number player_number INT DEFAULT NULL, CHANGE value value DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE element_collection CHANGE region region VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE publisher publisher VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE etat etat VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE buy_price buy_price DOUBLE PRECISION NOT NULL, CHANGE support support VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE player_number player_number INT NOT NULL, CHANGE value value DOUBLE PRECISION NOT NULL');
    }
}
