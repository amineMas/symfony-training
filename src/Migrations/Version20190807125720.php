<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190807125720 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_training (user_id INT NOT NULL, training_id INT NOT NULL, INDEX IDX_359F6E8FA76ED395 (user_id), INDEX IDX_359F6E8FBEFD98D1 (training_id), PRIMARY KEY(user_id, training_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_training ADD CONSTRAINT FK_359F6E8FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_training ADD CONSTRAINT FK_359F6E8FBEFD98D1 FOREIGN KEY (training_id) REFERENCES training (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649BEFD98D1');
        $this->addSql('DROP INDEX IDX_8D93D649BEFD98D1 ON user');
        $this->addSql('ALTER TABLE user DROP training_id, CHANGE prenom prenom VARCHAR(30) NOT NULL, CHANGE nom nom VARCHAR(30) NOT NULL, CHANGE email email VARCHAR(100) NOT NULL, CHANGE city city VARCHAR(100) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user_training');
        $this->addSql('ALTER TABLE user ADD training_id INT DEFAULT NULL, CHANGE prenom prenom VARCHAR(25) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE nom nom VARCHAR(20) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE email email VARCHAR(60) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE city city VARCHAR(30) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649BEFD98D1 FOREIGN KEY (training_id) REFERENCES training (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649BEFD98D1 ON user (training_id)');
    }
}
