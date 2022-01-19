<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220119181551 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_collection_attribute ADD collection_id INT NOT NULL');
        $this->addSql('ALTER TABLE item_collection_attribute ADD CONSTRAINT FK_A9A717B2514956FD FOREIGN KEY (collection_id) REFERENCES collection (id)');
        $this->addSql('CREATE INDEX IDX_A9A717B2514956FD ON item_collection_attribute (collection_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_collection_attribute DROP FOREIGN KEY FK_A9A717B2514956FD');
        $this->addSql('DROP INDEX IDX_A9A717B2514956FD ON item_collection_attribute');
        $this->addSql('ALTER TABLE item_collection_attribute DROP collection_id');
    }
}
