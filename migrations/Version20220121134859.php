<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220121134859 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE collections (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, theme_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(500) DEFAULT NULL, INDEX IDX_D325D3EEA76ED395 (user_id), INDEX IDX_D325D3EE59027487 (theme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE collections ADD CONSTRAINT FK_D325D3EEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE collections ADD CONSTRAINT FK_D325D3EE59027487 FOREIGN KEY (theme_id) REFERENCES theme (id)');
        $this->addSql('DROP TABLE collection');
        $this->addSql('ALTER TABLE item_collection_attribute ADD collection_id_id INT NOT NULL, ADD is_active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE item_collection_attribute ADD CONSTRAINT FK_A9A717B238BC2604 FOREIGN KEY (collection_id_id) REFERENCES collections (id)');
        $this->addSql('CREATE INDEX IDX_A9A717B238BC2604 ON item_collection_attribute (collection_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_collection_attribute DROP FOREIGN KEY FK_A9A717B238BC2604');
        $this->addSql('CREATE TABLE collection (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, theme_id INT DEFAULT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, image VARCHAR(500) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_FC4D653259027487 (theme_id), INDEX IDX_FC4D6532A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE collection ADD CONSTRAINT FK_FC4D653259027487 FOREIGN KEY (theme_id) REFERENCES theme (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE collection ADD CONSTRAINT FK_FC4D6532A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE collections');
        $this->addSql('DROP INDEX IDX_A9A717B238BC2604 ON item_collection_attribute');
        $this->addSql('ALTER TABLE item_collection_attribute DROP collection_id_id, DROP is_active');
    }
}
