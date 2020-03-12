<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180711085041 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE element_collection DROP FOREIGN KEY FK_5059975C253BEE07');
        $this->addSql('DROP INDEX IDX_5059975C253BEE07 ON element_collection');
        $this->addSql('ALTER TABLE element_collection CHANGE collection_name_id collection_name CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE element_collection ADD CONSTRAINT FK_5059975C145452E8 FOREIGN KEY (collection_name) REFERENCES collection (id) ON DELETE RESTRICT');
        $this->addSql('CREATE INDEX IDX_5059975C145452E8 ON element_collection (collection_name)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE element_collection DROP FOREIGN KEY FK_5059975C145452E8');
        $this->addSql('DROP INDEX IDX_5059975C145452E8 ON element_collection');
        $this->addSql('ALTER TABLE element_collection CHANGE collection_name collection_name_id CHAR(36) DEFAULT NULL COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE element_collection ADD CONSTRAINT FK_5059975C253BEE07 FOREIGN KEY (collection_name_id) REFERENCES collection (id)');
        $this->addSql('CREATE INDEX IDX_5059975C253BEE07 ON element_collection (collection_name_id)');
    }
}
