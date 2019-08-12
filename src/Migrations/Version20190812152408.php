<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190812152408 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(60) NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, add_date DATE NOT NULL, categorie VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(60) NOT NULL, description VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, add_date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, role VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, prenom VARCHAR(30) NOT NULL, nom VARCHAR(30) NOT NULL, email VARCHAR(100) NOT NULL, city VARCHAR(100) NOT NULL, zip_code INT NOT NULL, birth_date DATE NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_training (user_id INT NOT NULL, training_id INT NOT NULL, INDEX IDX_359F6E8FA76ED395 (user_id), INDEX IDX_359F6E8FBEFD98D1 (training_id), PRIMARY KEY(user_id, training_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_training ADD CONSTRAINT FK_359F6E8FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_training ADD CONSTRAINT FK_359F6E8FBEFD98D1 FOREIGN KEY (training_id) REFERENCES training (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_training DROP FOREIGN KEY FK_359F6E8FBEFD98D1');
        $this->addSql('ALTER TABLE user_training DROP FOREIGN KEY FK_359F6E8FA76ED395');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE training');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_training');
    }
}
