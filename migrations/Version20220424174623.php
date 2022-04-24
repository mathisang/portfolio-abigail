<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220424174623 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE outils (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_outils (project_id INT NOT NULL, outils_id INT NOT NULL, INDEX IDX_CDE95B90166D1F9C (project_id), INDEX IDX_CDE95B90AF7E699 (outils_id), PRIMARY KEY(project_id, outils_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE project_outils ADD CONSTRAINT FK_CDE95B90166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_outils ADD CONSTRAINT FK_CDE95B90AF7E699 FOREIGN KEY (outils_id) REFERENCES outils (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project_outils DROP FOREIGN KEY FK_CDE95B90AF7E699');
        $this->addSql('DROP TABLE outils');
        $this->addSql('DROP TABLE project_outils');
    }
}
