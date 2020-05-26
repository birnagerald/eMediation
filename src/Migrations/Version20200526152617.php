<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200526152617 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE conflict (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD conflict2_id INT DEFAULT NULL, ADD conflict1_id INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649DF187DB5 FOREIGN KEY (conflict2_id) REFERENCES conflict (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649CDADD25B FOREIGN KEY (conflict1_id) REFERENCES conflict (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649DF187DB5 ON user (conflict2_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649CDADD25B ON user (conflict1_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649DF187DB5');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649CDADD25B');
        $this->addSql('DROP TABLE conflict');
        $this->addSql('DROP INDEX IDX_8D93D649DF187DB5 ON user');
        $this->addSql('DROP INDEX IDX_8D93D649CDADD25B ON user');
        $this->addSql('ALTER TABLE user DROP conflict2_id, DROP conflict1_id, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
