<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220105080146 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tags ADD item_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tags ADD CONSTRAINT FK_6FBC9426126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('CREATE INDEX IDX_6FBC9426126F525E ON tags (item_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tags DROP FOREIGN KEY FK_6FBC9426126F525E');
        $this->addSql('DROP INDEX IDX_6FBC9426126F525E ON tags');
        $this->addSql('ALTER TABLE tags DROP item_id');
    }
}
