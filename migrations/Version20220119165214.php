<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220119165214 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_collecion_attribute DROP FOREIGN KEY FK_E07886EBBDE5FE26');
        $this->addSql('CREATE TABLE item_attribute (id INT AUTO_INCREMENT NOT NULL, item_id INT NOT NULL, value INT NOT NULL, INDEX IDX_F6A0F90B126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_collection (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_collection_attribute (id INT AUTO_INCREMENT NOT NULL, item_collection_id INT NOT NULL, attribute_type_id INT NOT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_A9A717B2BDE5FE26 (item_collection_id), INDEX IDX_A9A717B24ED0D557 (attribute_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE item_attribute ADD CONSTRAINT FK_F6A0F90B126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE item_collection_attribute ADD CONSTRAINT FK_A9A717B2BDE5FE26 FOREIGN KEY (item_collection_id) REFERENCES item_collection (id)');
        $this->addSql('ALTER TABLE item_collection_attribute ADD CONSTRAINT FK_A9A717B24ED0D557 FOREIGN KEY (attribute_type_id) REFERENCES attribute_type (id)');
        $this->addSql('DROP TABLE item_collecion');
        $this->addSql('DROP TABLE item_collecion_attribute');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_collection_attribute DROP FOREIGN KEY FK_A9A717B2BDE5FE26');
        $this->addSql('CREATE TABLE item_collecion (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE item_collecion_attribute (id INT AUTO_INCREMENT NOT NULL, item_collection_id INT NOT NULL, attribute_type_id INT NOT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_E07886EB4ED0D557 (attribute_type_id), INDEX IDX_E07886EBBDE5FE26 (item_collection_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE item_collecion_attribute ADD CONSTRAINT FK_E07886EB4ED0D557 FOREIGN KEY (attribute_type_id) REFERENCES attribute_type (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE item_collecion_attribute ADD CONSTRAINT FK_E07886EBBDE5FE26 FOREIGN KEY (item_collection_id) REFERENCES item_collecion (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE item_attribute');
        $this->addSql('DROP TABLE item_collection');
        $this->addSql('DROP TABLE item_collection_attribute');
    }
}
