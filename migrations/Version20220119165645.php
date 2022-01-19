<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220119165645 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_attribute ADD item_collection_attribute_id INT NOT NULL');
        $this->addSql('ALTER TABLE item_attribute ADD CONSTRAINT FK_F6A0F90BEDAA5D3A FOREIGN KEY (item_collection_attribute_id) REFERENCES item_collection_attribute (id)');
        $this->addSql('CREATE INDEX IDX_F6A0F90BEDAA5D3A ON item_attribute (item_collection_attribute_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_attribute DROP FOREIGN KEY FK_F6A0F90BEDAA5D3A');
        $this->addSql('DROP INDEX IDX_F6A0F90BEDAA5D3A ON item_attribute');
        $this->addSql('ALTER TABLE item_attribute DROP item_collection_attribute_id');
    }
}
