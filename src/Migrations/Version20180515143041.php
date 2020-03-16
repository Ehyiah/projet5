<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180515143041 extends AbstractMigration
{
    public function up(Schema $schema):void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE image_collection DROP FOREIGN KEY FK_909372041547B4F6');
        $this->addSql('DROP INDEX IDX_909372041547B4F6 ON image_collection');
        $this->addSql('ALTER TABLE image_collection CHANGE image_collection_id image_element_collection_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE image_collection ADD CONSTRAINT FK_90937204717CD3A8 FOREIGN KEY (image_element_collection_id) REFERENCES element_collection (id)');
        $this->addSql('CREATE INDEX IDX_90937204717CD3A8 ON image_collection (image_element_collection_id)');
    }

    public function down(Schema $schema):void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE image_collection DROP FOREIGN KEY FK_90937204717CD3A8');
        $this->addSql('DROP INDEX IDX_90937204717CD3A8 ON image_collection');
        $this->addSql('ALTER TABLE image_collection CHANGE image_element_collection_id image_collection_id CHAR(36) DEFAULT NULL COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE image_collection ADD CONSTRAINT FK_909372041547B4F6 FOREIGN KEY (image_collection_id) REFERENCES element_collection (id)');
        $this->addSql('CREATE INDEX IDX_909372041547B4F6 ON image_collection (image_collection_id)');
    }
}
