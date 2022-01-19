<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220119164034 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_collecion_attribute ADD item_collection_id INT NOT NULL, ADD attribute_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE item_collecion_attribute ADD CONSTRAINT FK_E07886EBBDE5FE26 FOREIGN KEY (item_collection_id) REFERENCES item_collecion (id)');
        $this->addSql('ALTER TABLE item_collecion_attribute ADD CONSTRAINT FK_E07886EB4ED0D557 FOREIGN KEY (attribute_type_id) REFERENCES attribute_type (id)');
        $this->addSql('CREATE INDEX IDX_E07886EBBDE5FE26 ON item_collecion_attribute (item_collection_id)');
        $this->addSql('CREATE INDEX IDX_E07886EB4ED0D557 ON item_collecion_attribute (attribute_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_collecion_attribute DROP FOREIGN KEY FK_E07886EBBDE5FE26');
        $this->addSql('ALTER TABLE item_collecion_attribute DROP FOREIGN KEY FK_E07886EB4ED0D557');
        $this->addSql('DROP INDEX IDX_E07886EBBDE5FE26 ON item_collecion_attribute');
        $this->addSql('DROP INDEX IDX_E07886EB4ED0D557 ON item_collecion_attribute');
        $this->addSql('ALTER TABLE item_collecion_attribute DROP item_collection_id, DROP attribute_type_id');
    }
}
