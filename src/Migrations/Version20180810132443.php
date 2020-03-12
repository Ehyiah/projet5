<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180810132443 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE collection DROP FOREIGN KEY FK_FC4D65323DA5256D');
        $this->addSql('ALTER TABLE collection ADD CONSTRAINT FK_FC4D65323DA5256D FOREIGN KEY (image_id) REFERENCES image_collection (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE collection DROP FOREIGN KEY FK_FC4D65323DA5256D');
        $this->addSql('ALTER TABLE collection ADD CONSTRAINT FK_FC4D65323DA5256D FOREIGN KEY (image_id) REFERENCES image_collection (id) ON DELETE CASCADE');
    }
}
