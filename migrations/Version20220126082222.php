<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220126082222 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attribute_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE collection (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, theme_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(500) DEFAULT NULL, INDEX IDX_FC4D6532A76ED395 (user_id), INDEX IDX_FC4D653259027487 (theme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE collection_attribute (id INT AUTO_INCREMENT NOT NULL, attribute_type_id INT NOT NULL, collection_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_DC525F994ED0D557 (attribute_type_id), INDEX IDX_DC525F99514956FD (collection_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, item_id INT NOT NULL, content LONGTEXT NOT NULL, create_at DATETIME NOT NULL, INDEX IDX_9474526CA76ED395 (user_id), INDEX IDX_9474526C126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, collection_id INT NOT NULL, title VARCHAR(255) NOT NULL, create_date DATETIME NOT NULL, INDEX IDX_1F1B251E514956FD (collection_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_user (item_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_45A392B2126F525E (item_id), INDEX IDX_45A392B2A76ED395 (user_id), PRIMARY KEY(item_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_tags (item_id INT NOT NULL, tags_id INT NOT NULL, INDEX IDX_A78CD0DD126F525E (item_id), INDEX IDX_A78CD0DD8D7B4FB4 (tags_id), PRIMARY KEY(item_id, tags_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_attribute (id INT AUTO_INCREMENT NOT NULL, collection_attribute_id INT NOT NULL, item_id INT NOT NULL, value VARCHAR(255) NOT NULL, INDEX IDX_F6A0F90B2CC537D0 (collection_attribute_id), INDEX IDX_F6A0F90B126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tags (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE collection ADD CONSTRAINT FK_FC4D6532A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE collection ADD CONSTRAINT FK_FC4D653259027487 FOREIGN KEY (theme_id) REFERENCES theme (id)');
        $this->addSql('ALTER TABLE collection_attribute ADD CONSTRAINT FK_DC525F994ED0D557 FOREIGN KEY (attribute_type_id) REFERENCES attribute_type (id)');
        $this->addSql('ALTER TABLE collection_attribute ADD CONSTRAINT FK_DC525F99514956FD FOREIGN KEY (collection_id) REFERENCES collection (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E514956FD FOREIGN KEY (collection_id) REFERENCES collection (id)');
        $this->addSql('ALTER TABLE item_user ADD CONSTRAINT FK_45A392B2126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_user ADD CONSTRAINT FK_45A392B2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_tags ADD CONSTRAINT FK_A78CD0DD126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_tags ADD CONSTRAINT FK_A78CD0DD8D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_attribute ADD CONSTRAINT FK_F6A0F90B2CC537D0 FOREIGN KEY (collection_attribute_id) REFERENCES collection_attribute (id)');
        $this->addSql('ALTER TABLE item_attribute ADD CONSTRAINT FK_F6A0F90B126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collection_attribute DROP FOREIGN KEY FK_DC525F994ED0D557');
        $this->addSql('ALTER TABLE collection_attribute DROP FOREIGN KEY FK_DC525F99514956FD');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E514956FD');
        $this->addSql('ALTER TABLE item_attribute DROP FOREIGN KEY FK_F6A0F90B2CC537D0');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C126F525E');
        $this->addSql('ALTER TABLE item_user DROP FOREIGN KEY FK_45A392B2126F525E');
        $this->addSql('ALTER TABLE item_tags DROP FOREIGN KEY FK_A78CD0DD126F525E');
        $this->addSql('ALTER TABLE item_attribute DROP FOREIGN KEY FK_F6A0F90B126F525E');
        $this->addSql('ALTER TABLE item_tags DROP FOREIGN KEY FK_A78CD0DD8D7B4FB4');
        $this->addSql('ALTER TABLE collection DROP FOREIGN KEY FK_FC4D653259027487');
        $this->addSql('ALTER TABLE collection DROP FOREIGN KEY FK_FC4D6532A76ED395');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('ALTER TABLE item_user DROP FOREIGN KEY FK_45A392B2A76ED395');
        $this->addSql('DROP TABLE attribute_type');
        $this->addSql('DROP TABLE collection');
        $this->addSql('DROP TABLE collection_attribute');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE item_user');
        $this->addSql('DROP TABLE item_tags');
        $this->addSql('DROP TABLE item_attribute');
        $this->addSql('DROP TABLE tags');
        $this->addSql('DROP TABLE theme');
        $this->addSql('DROP TABLE user');
    }
}
