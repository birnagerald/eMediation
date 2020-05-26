<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200526154021 extends AbstractMigration
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
        $this->addSql('CREATE TABLE conflict_user (conflict_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_715A4BA2C05AB355 (conflict_id), INDEX IDX_715A4BA2A76ED395 (user_id), PRIMARY KEY(conflict_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE conflict_user ADD CONSTRAINT FK_715A4BA2C05AB355 FOREIGN KEY (conflict_id) REFERENCES conflict (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE conflict_user ADD CONSTRAINT FK_715A4BA2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649CDADD25B');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649DF187DB5');
        $this->addSql('DROP INDEX IDX_8D93D649CDADD25B ON user');
        $this->addSql('DROP INDEX IDX_8D93D649DF187DB5 ON user');
        $this->addSql('ALTER TABLE user DROP conflict2_id, DROP conflict1_id, CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE conflict_user DROP FOREIGN KEY FK_715A4BA2C05AB355');
        $this->addSql('DROP TABLE conflict');
        $this->addSql('DROP TABLE conflict_user');
        $this->addSql('ALTER TABLE user ADD conflict2_id INT DEFAULT NULL, ADD conflict1_id INT DEFAULT NULL, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649CDADD25B FOREIGN KEY (conflict1_id) REFERENCES conflict (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649DF187DB5 FOREIGN KEY (conflict2_id) REFERENCES conflict (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649CDADD25B ON user (conflict1_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649DF187DB5 ON user (conflict2_id)');
    }
}
