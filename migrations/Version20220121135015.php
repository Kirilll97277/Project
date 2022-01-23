<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220121135015 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_collection_attribute ADD attribute_type_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE item_collection_attribute ADD CONSTRAINT FK_A9A717B2752E1EC5 FOREIGN KEY (attribute_type_id_id) REFERENCES attribute_type (id)');
        $this->addSql('CREATE INDEX IDX_A9A717B2752E1EC5 ON item_collection_attribute (attribute_type_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_collection_attribute DROP FOREIGN KEY FK_A9A717B2752E1EC5');
        $this->addSql('DROP INDEX IDX_A9A717B2752E1EC5 ON item_collection_attribute');
        $this->addSql('ALTER TABLE item_collection_attribute DROP attribute_type_id_id');
    }
}
