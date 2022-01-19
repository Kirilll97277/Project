<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220119180132 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_collection_attribute DROP FOREIGN KEY FK_A9A717B2BDE5FE26');
        $this->addSql('DROP TABLE item_collection');
        $this->addSql('DROP INDEX IDX_A9A717B2BDE5FE26 ON item_collection_attribute');
        $this->addSql('ALTER TABLE item_collection_attribute DROP item_collection_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE item_collection (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE item_collection_attribute ADD item_collection_id INT NOT NULL');
        $this->addSql('ALTER TABLE item_collection_attribute ADD CONSTRAINT FK_A9A717B2BDE5FE26 FOREIGN KEY (item_collection_id) REFERENCES item_collection (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_A9A717B2BDE5FE26 ON item_collection_attribute (item_collection_id)');
    }
}
