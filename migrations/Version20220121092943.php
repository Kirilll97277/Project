<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220121092943 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_collection_attribute DROP FOREIGN KEY FK_A9A717B24ED0D557');
        $this->addSql('DROP INDEX IDX_A9A717B24ED0D557 ON item_collection_attribute');
        $this->addSql('ALTER TABLE item_collection_attribute DROP attribute_type_id, DROP is_active');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_collection_attribute ADD attribute_type_id INT NOT NULL, ADD is_active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE item_collection_attribute ADD CONSTRAINT FK_A9A717B24ED0D557 FOREIGN KEY (attribute_type_id) REFERENCES attribute_type (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_A9A717B24ED0D557 ON item_collection_attribute (attribute_type_id)');
    }
}
