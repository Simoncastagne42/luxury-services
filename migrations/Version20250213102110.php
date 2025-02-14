<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250213102110 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE job_offers (id INT AUTO_INCREMENT NOT NULL, job_category_id INT DEFAULT NULL, recruiter_id INT NOT NULL, job_tittle VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, salary NUMERIC(10, 0) NOT NULL, description VARCHAR(255) NOT NULL, date_created DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_8A4229A6712A86AB (job_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE job_offers ADD CONSTRAINT FK_8A4229A6712A86AB FOREIGN KEY (job_category_id) REFERENCES category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job_offers DROP FOREIGN KEY FK_8A4229A6712A86AB');
        $this->addSql('DROP TABLE job_offers');
    }
}
