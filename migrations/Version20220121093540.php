<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220121093540 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attribute_type ADD item_collection_attribute_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE attribute_type ADD CONSTRAINT FK_D736F3A1EDAA5D3A FOREIGN KEY (item_collection_attribute_id) REFERENCES item_collection_attribute (id)');
        $this->addSql('CREATE INDEX IDX_D736F3A1EDAA5D3A ON attribute_type (item_collection_attribute_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attribute_type DROP FOREIGN KEY FK_D736F3A1EDAA5D3A');
        $this->addSql('DROP INDEX IDX_D736F3A1EDAA5D3A ON attribute_type');
        $this->addSql('ALTER TABLE attribute_type DROP item_collection_attribute_id');
    }
}
