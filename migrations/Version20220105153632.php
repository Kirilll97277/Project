<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220105153632 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attribute_value ADD item_id INT NOT NULL');
        $this->addSql('ALTER TABLE attribute_value ADD CONSTRAINT FK_FE4FBB82126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('CREATE INDEX IDX_FE4FBB82126F525E ON attribute_value (item_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attribute_value DROP FOREIGN KEY FK_FE4FBB82126F525E');
        $this->addSql('DROP INDEX IDX_FE4FBB82126F525E ON attribute_value');
        $this->addSql('ALTER TABLE attribute_value DROP item_id');
    }
}
