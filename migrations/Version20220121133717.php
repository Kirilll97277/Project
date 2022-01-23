<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220121133717 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attribute_type DROP FOREIGN KEY FK_D736F3A1EDAA5D3A');
        $this->addSql('DROP INDEX IDX_D736F3A1EDAA5D3A ON attribute_type');
        $this->addSql('ALTER TABLE attribute_type DROP item_collection_attribute_id');
        $this->addSql('ALTER TABLE item_attribute DROP FOREIGN KEY FK_F6A0F90B126F525E');
        $this->addSql('ALTER TABLE item_attribute DROP FOREIGN KEY FK_F6A0F90BEDAA5D3A');
        $this->addSql('DROP INDEX IDX_F6A0F90B126F525E ON item_attribute');
        $this->addSql('DROP INDEX IDX_F6A0F90BEDAA5D3A ON item_attribute');
        $this->addSql('ALTER TABLE item_attribute DROP item_id, DROP item_collection_attribute_id');
        $this->addSql('ALTER TABLE item_collection_attribute DROP FOREIGN KEY FK_A9A717B2514956FD');
        $this->addSql('DROP INDEX IDX_A9A717B2514956FD ON item_collection_attribute');
        $this->addSql('ALTER TABLE item_collection_attribute DROP collection_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attribute_type ADD item_collection_attribute_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE attribute_type ADD CONSTRAINT FK_D736F3A1EDAA5D3A FOREIGN KEY (item_collection_attribute_id) REFERENCES item_collection_attribute (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D736F3A1EDAA5D3A ON attribute_type (item_collection_attribute_id)');
        $this->addSql('ALTER TABLE item_attribute ADD item_id INT NOT NULL, ADD item_collection_attribute_id INT NOT NULL');
        $this->addSql('ALTER TABLE item_attribute ADD CONSTRAINT FK_F6A0F90B126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE item_attribute ADD CONSTRAINT FK_F6A0F90BEDAA5D3A FOREIGN KEY (item_collection_attribute_id) REFERENCES item_collection_attribute (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_F6A0F90B126F525E ON item_attribute (item_id)');
        $this->addSql('CREATE INDEX IDX_F6A0F90BEDAA5D3A ON item_attribute (item_collection_attribute_id)');
        $this->addSql('ALTER TABLE item_collection_attribute ADD collection_id INT NOT NULL');
        $this->addSql('ALTER TABLE item_collection_attribute ADD CONSTRAINT FK_A9A717B2514956FD FOREIGN KEY (collection_id) REFERENCES collection (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_A9A717B2514956FD ON item_collection_attribute (collection_id)');
    }
}
