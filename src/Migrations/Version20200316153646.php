<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200316153646 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category_collection (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', category_collection VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE collection (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', image_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', owner_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', category_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', collection_name VARCHAR(255) NOT NULL, creation_date DATETIME NOT NULL, update_date DATETIME DEFAULT NULL, hidden INT NOT NULL, tag VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_FC4D65323DA5256D (image_id), INDEX IDX_FC4D65327E3C61F9 (owner_id), INDEX IDX_FC4D653212469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', collection_name_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', author_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', signaled INT DEFAULT NULL, creation_date DATETIME NOT NULL, comment_content VARCHAR(255) NOT NULL, INDEX IDX_9474526C253BEE07 (collection_name_id), INDEX IDX_9474526CF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE element_collection (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', collection_name CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', title VARCHAR(255) NOT NULL, region VARCHAR(255) DEFAULT NULL, author VARCHAR(255) DEFAULT NULL, publisher VARCHAR(255) DEFAULT NULL, etat VARCHAR(255) DEFAULT NULL, buy_price DOUBLE PRECISION DEFAULT NULL, support VARCHAR(255) DEFAULT NULL, player_number INT DEFAULT NULL, value DOUBLE PRECISION DEFAULT NULL, INDEX IDX_5059975C145452E8 (collection_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE elements_images (element_collection_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', image_collection_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_401E6EA42F50E739 (element_collection_id), UNIQUE INDEX UNIQ_401E6EA41547B4F6 (image_collection_id), PRIMARY KEY(element_collection_id, image_collection_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_collection (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', title VARCHAR(255) NOT NULL, creation_date DATETIME NOT NULL, update_date DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, groupe INT DEFAULT NULL, creation_date DATETIME NOT NULL, validation_date DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', token_reset VARCHAR(255) DEFAULT NULL, token_validity DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649F343BB0C (token_reset), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE collection ADD CONSTRAINT FK_FC4D65323DA5256D FOREIGN KEY (image_id) REFERENCES image_collection (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE collection ADD CONSTRAINT FK_FC4D65327E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE collection ADD CONSTRAINT FK_FC4D653212469DE2 FOREIGN KEY (category_id) REFERENCES category_collection (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C253BEE07 FOREIGN KEY (collection_name_id) REFERENCES collection (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE element_collection ADD CONSTRAINT FK_5059975C145452E8 FOREIGN KEY (collection_name) REFERENCES collection (id)');
        $this->addSql('ALTER TABLE elements_images ADD CONSTRAINT FK_401E6EA42F50E739 FOREIGN KEY (element_collection_id) REFERENCES element_collection (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE elements_images ADD CONSTRAINT FK_401E6EA41547B4F6 FOREIGN KEY (image_collection_id) REFERENCES image_collection (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE collection DROP FOREIGN KEY FK_FC4D653212469DE2');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C253BEE07');
        $this->addSql('ALTER TABLE element_collection DROP FOREIGN KEY FK_5059975C145452E8');
        $this->addSql('ALTER TABLE elements_images DROP FOREIGN KEY FK_401E6EA42F50E739');
        $this->addSql('ALTER TABLE collection DROP FOREIGN KEY FK_FC4D65323DA5256D');
        $this->addSql('ALTER TABLE elements_images DROP FOREIGN KEY FK_401E6EA41547B4F6');
        $this->addSql('ALTER TABLE collection DROP FOREIGN KEY FK_FC4D65327E3C61F9');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF675F31B');
        $this->addSql('DROP TABLE category_collection');
        $this->addSql('DROP TABLE collection');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE element_collection');
        $this->addSql('DROP TABLE elements_images');
        $this->addSql('DROP TABLE image_collection');
        $this->addSql('DROP TABLE user');
    }
}
