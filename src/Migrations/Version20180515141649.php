<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180515141649 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE collection ADD owner_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', ADD category_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE collection ADD CONSTRAINT FK_FC4D65327E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE collection ADD CONSTRAINT FK_FC4D653212469DE2 FOREIGN KEY (category_id) REFERENCES category_collection (id)');
        $this->addSql('CREATE INDEX IDX_FC4D65327E3C61F9 ON collection (owner_id)');
        $this->addSql('CREATE INDEX IDX_FC4D653212469DE2 ON collection (category_id)');
        $this->addSql('ALTER TABLE comment ADD collection_name_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', ADD author_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C253BEE07 FOREIGN KEY (collection_name_id) REFERENCES collection (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9474526C253BEE07 ON comment (collection_name_id)');
        $this->addSql('CREATE INDEX IDX_9474526CF675F31B ON comment (author_id)');
        $this->addSql('ALTER TABLE element_collection ADD collection_name_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE element_collection ADD CONSTRAINT FK_5059975C253BEE07 FOREIGN KEY (collection_name_id) REFERENCES collection (id)');
        $this->addSql('CREATE INDEX IDX_5059975C253BEE07 ON element_collection (collection_name_id)');
        $this->addSql('ALTER TABLE image_collection ADD image_collection_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE image_collection ADD CONSTRAINT FK_909372041547B4F6 FOREIGN KEY (image_collection_id) REFERENCES element_collection (id)');
        $this->addSql('CREATE INDEX IDX_909372041547B4F6 ON image_collection (image_collection_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE collection DROP FOREIGN KEY FK_FC4D65327E3C61F9');
        $this->addSql('ALTER TABLE collection DROP FOREIGN KEY FK_FC4D653212469DE2');
        $this->addSql('DROP INDEX IDX_FC4D65327E3C61F9 ON collection');
        $this->addSql('DROP INDEX IDX_FC4D653212469DE2 ON collection');
        $this->addSql('ALTER TABLE collection DROP owner_id, DROP category_id');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C253BEE07');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF675F31B');
        $this->addSql('DROP INDEX IDX_9474526C253BEE07 ON comment');
        $this->addSql('DROP INDEX IDX_9474526CF675F31B ON comment');
        $this->addSql('ALTER TABLE comment DROP collection_name_id, DROP author_id');
        $this->addSql('ALTER TABLE element_collection DROP FOREIGN KEY FK_5059975C253BEE07');
        $this->addSql('DROP INDEX IDX_5059975C253BEE07 ON element_collection');
        $this->addSql('ALTER TABLE element_collection DROP collection_name_id');
        $this->addSql('ALTER TABLE image_collection DROP FOREIGN KEY FK_909372041547B4F6');
        $this->addSql('DROP INDEX IDX_909372041547B4F6 ON image_collection');
        $this->addSql('ALTER TABLE image_collection DROP image_collection_id');
    }
}
