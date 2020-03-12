<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180712135746 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE elements_images (element_collection_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', image_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_401E6EA42F50E739 (element_collection_id), UNIQUE INDEX UNIQ_401E6EA43DA5256D (image_id), PRIMARY KEY(element_collection_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE elements_images ADD CONSTRAINT FK_401E6EA42F50E739 FOREIGN KEY (element_collection_id) REFERENCES element_collection (id)');
        $this->addSql('ALTER TABLE elements_images ADD CONSTRAINT FK_401E6EA43DA5256D FOREIGN KEY (image_id) REFERENCES image_collection (id)');
        $this->addSql('ALTER TABLE image_collection DROP FOREIGN KEY FK_90937204717CD3A8');
        $this->addSql('DROP INDEX IDX_90937204717CD3A8 ON image_collection');
        $this->addSql('ALTER TABLE image_collection DROP image_element_collection_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE elements_images');
        $this->addSql('ALTER TABLE image_collection ADD image_element_collection_id CHAR(36) DEFAULT NULL COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE image_collection ADD CONSTRAINT FK_90937204717CD3A8 FOREIGN KEY (image_element_collection_id) REFERENCES element_collection (id)');
        $this->addSql('CREATE INDEX IDX_90937204717CD3A8 ON image_collection (image_element_collection_id)');
    }
}
