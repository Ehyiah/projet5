<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180807083155 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE elements_images DROP FOREIGN KEY FK_401E6EA41547B4F6');
        $this->addSql('ALTER TABLE elements_images ADD CONSTRAINT FK_401E6EA41547B4F6 FOREIGN KEY (image_collection_id) REFERENCES image_collection (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE elements_images DROP FOREIGN KEY FK_401E6EA41547B4F6');
        $this->addSql('ALTER TABLE elements_images ADD CONSTRAINT FK_401E6EA41547B4F6 FOREIGN KEY (image_collection_id) REFERENCES image_collection (id)');
    }
}
