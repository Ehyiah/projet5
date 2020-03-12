<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180611174213 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE image_collection ADD image_collection_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE image_collection ADD CONSTRAINT FK_909372041547B4F6 FOREIGN KEY (image_collection_id) REFERENCES collection (id)');
        $this->addSql('CREATE INDEX IDX_909372041547B4F6 ON image_collection (image_collection_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE image_collection DROP FOREIGN KEY FK_909372041547B4F6');
        $this->addSql('DROP INDEX IDX_909372041547B4F6 ON image_collection');
        $this->addSql('ALTER TABLE image_collection DROP image_collection_id');
    }
}
