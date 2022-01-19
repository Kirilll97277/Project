<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220119172234 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E514956FD');
        $this->addSql('DROP INDEX IDX_1F1B251E514956FD ON item');
        $this->addSql('ALTER TABLE item DROP collection_id, DROP created_at');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item ADD collection_id INT DEFAULT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E514956FD FOREIGN KEY (collection_id) REFERENCES collection (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_1F1B251E514956FD ON item (collection_id)');
    }
}
