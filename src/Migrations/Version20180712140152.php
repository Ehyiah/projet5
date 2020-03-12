<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180712140152 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE elements_images DROP FOREIGN KEY FK_401E6EA43DA5256D');
        $this->addSql('DROP INDEX UNIQ_401E6EA43DA5256D ON elements_images');
        $this->addSql('ALTER TABLE elements_images DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE elements_images CHANGE image_id image_collection_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE elements_images ADD CONSTRAINT FK_401E6EA41547B4F6 FOREIGN KEY (image_collection_id) REFERENCES image_collection (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_401E6EA41547B4F6 ON elements_images (image_collection_id)');
        $this->addSql('ALTER TABLE elements_images ADD PRIMARY KEY (element_collection_id, image_collection_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE elements_images DROP FOREIGN KEY FK_401E6EA41547B4F6');
        $this->addSql('DROP INDEX UNIQ_401E6EA41547B4F6 ON elements_images');
        $this->addSql('ALTER TABLE elements_images DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE elements_images CHANGE image_collection_id image_id CHAR(36) NOT NULL COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE elements_images ADD CONSTRAINT FK_401E6EA43DA5256D FOREIGN KEY (image_id) REFERENCES image_collection (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_401E6EA43DA5256D ON elements_images (image_id)');
        $this->addSql('ALTER TABLE elements_images ADD PRIMARY KEY (element_collection_id, image_id)');
    }
}
