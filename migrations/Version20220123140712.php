<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220123140712 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_attribute DROP FOREIGN KEY FK_F6A0F90B55E38587');
        $this->addSql('DROP INDEX IDX_F6A0F90B55E38587 ON item_attribute');
        $this->addSql('ALTER TABLE item_attribute DROP item_id_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_attribute ADD item_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE item_attribute ADD CONSTRAINT FK_F6A0F90B55E38587 FOREIGN KEY (item_id_id) REFERENCES item (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_F6A0F90B55E38587 ON item_attribute (item_id_id)');
    }
}
