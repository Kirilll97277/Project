<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220107165057 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attribute ADD attribute_value_id INT NOT NULL');
        $this->addSql('ALTER TABLE attribute ADD CONSTRAINT FK_FA7AEFFB65A22152 FOREIGN KEY (attribute_value_id) REFERENCES attribute_value (id)');
        $this->addSql('CREATE INDEX IDX_FA7AEFFB65A22152 ON attribute (attribute_value_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attribute DROP FOREIGN KEY FK_FA7AEFFB65A22152');
        $this->addSql('DROP INDEX IDX_FA7AEFFB65A22152 ON attribute');
        $this->addSql('ALTER TABLE attribute DROP attribute_value_id');
    }
}
