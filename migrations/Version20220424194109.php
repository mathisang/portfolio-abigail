<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220424194109 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE project_competences (project_id INT NOT NULL, competences_id INT NOT NULL, INDEX IDX_13EF8035166D1F9C (project_id), INDEX IDX_13EF8035A660B158 (competences_id), PRIMARY KEY(project_id, competences_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_notions (project_id INT NOT NULL, notions_id INT NOT NULL, INDEX IDX_12DC4D18166D1F9C (project_id), INDEX IDX_12DC4D18A660E36F (notions_id), PRIMARY KEY(project_id, notions_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE project_competences ADD CONSTRAINT FK_13EF8035166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_competences ADD CONSTRAINT FK_13EF8035A660B158 FOREIGN KEY (competences_id) REFERENCES competences (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_notions ADD CONSTRAINT FK_12DC4D18166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_notions ADD CONSTRAINT FK_12DC4D18A660E36F FOREIGN KEY (notions_id) REFERENCES notions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project ADD theme_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE59027487 FOREIGN KEY (theme_id) REFERENCES themes (id)');
        $this->addSql('CREATE INDEX IDX_2FB3D0EE59027487 ON project (theme_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE project_competences');
        $this->addSql('DROP TABLE project_notions');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE59027487');
        $this->addSql('DROP INDEX IDX_2FB3D0EE59027487 ON project');
        $this->addSql('ALTER TABLE project DROP theme_id');
    }
}
