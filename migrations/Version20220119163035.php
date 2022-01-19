<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220119163035 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE item_collection_attribute');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE item_collection_attribute (id INT AUTO_INCREMENT NOT NULL, item_collection_id INT NOT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_A9A717B2BDE5FE26 (item_collection_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE item_collection_attribute ADD CONSTRAINT FK_A9A717B2BDE5FE26 FOREIGN KEY (item_collection_id) REFERENCES item_collecion (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
