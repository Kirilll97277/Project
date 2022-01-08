<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220105083359 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attribute_value ADD attribute_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE attribute_value ADD CONSTRAINT FK_FE4FBB824ED0D557 FOREIGN KEY (attribute_type_id) REFERENCES attribute_type (id)');
        $this->addSql('CREATE INDEX IDX_FE4FBB824ED0D557 ON attribute_value (attribute_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attribute_value DROP FOREIGN KEY FK_FE4FBB824ED0D557');
        $this->addSql('DROP INDEX IDX_FE4FBB824ED0D557 ON attribute_value');
        $this->addSql('ALTER TABLE attribute_value DROP attribute_type_id');
    }
}