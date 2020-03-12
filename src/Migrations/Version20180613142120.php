<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180613142120 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE collection ADD image_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE collection ADD CONSTRAINT FK_FC4D65323DA5256D FOREIGN KEY (image_id) REFERENCES image_collection (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FC4D65323DA5256D ON collection (image_id)');
        $this->addSql('ALTER TABLE image_collection DROP FOREIGN KEY FK_909372041547B4F6');
        $this->addSql('DROP INDEX IDX_909372041547B4F6 ON image_collection');
        $this->addSql('ALTER TABLE image_collection DROP image_collection_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE collection DROP FOREIGN KEY FK_FC4D65323DA5256D');
        $this->addSql('DROP INDEX UNIQ_FC4D65323DA5256D ON collection');
        $this->addSql('ALTER TABLE collection DROP image_id');
        $this->addSql('ALTER TABLE image_collection ADD image_collection_id CHAR(36) DEFAULT NULL COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE image_collection ADD CONSTRAINT FK_909372041547B4F6 FOREIGN KEY (image_collection_id) REFERENCES collection (id)');
        $this->addSql('CREATE INDEX IDX_909372041547B4F6 ON image_collection (image_collection_id)');
    }
}
