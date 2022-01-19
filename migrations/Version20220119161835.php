<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220119161835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attribute DROP FOREIGN KEY FK_FA7AEFFB4ED0D557');
        $this->addSql('ALTER TABLE attribute DROP FOREIGN KEY FK_FA7AEFFB65A22152');
        $this->addSql('CREATE TABLE item_collecion (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE attribute');
        $this->addSql('DROP TABLE attribute_type');
        $this->addSql('DROP TABLE attribute_value');
        $this->addSql('ALTER TABLE item ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attribute (id INT AUTO_INCREMENT NOT NULL, attribute_type_id INT NOT NULL, attribute_value_id INT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_FA7AEFFB4ED0D557 (attribute_type_id), INDEX IDX_FA7AEFFB65A22152 (attribute_value_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE attribute_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE attribute_value (id INT AUTO_INCREMENT NOT NULL, item_id INT DEFAULT NULL, is_active TINYINT(1) NOT NULL, display_order INT NOT NULL, value LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_FE4FBB82126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE attribute ADD CONSTRAINT FK_FA7AEFFB4ED0D557 FOREIGN KEY (attribute_type_id) REFERENCES attribute_type (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE attribute ADD CONSTRAINT FK_FA7AEFFB65A22152 FOREIGN KEY (attribute_value_id) REFERENCES attribute_value (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE attribute_value ADD CONSTRAINT FK_FE4FBB82126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE item_collecion');
        $this->addSql('ALTER TABLE item DROP created_at');
    }
}
