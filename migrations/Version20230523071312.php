<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230523071312 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gite DROP FOREIGN KEY FK_B638C92C7B2EEE88');
        $this->addSql('DROP INDEX IDX_B638C92C7B2EEE88 ON gite');
        $this->addSql('ALTER TABLE gite CHANGE propritaire_id proprietaire_id INT NOT NULL');
        $this->addSql('ALTER TABLE gite ADD CONSTRAINT FK_B638C92C76C50E4A FOREIGN KEY (proprietaire_id) REFERENCES proprietaire (id)');
        $this->addSql('CREATE INDEX IDX_B638C92C76C50E4A ON gite (proprietaire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gite DROP FOREIGN KEY FK_B638C92C76C50E4A');
        $this->addSql('DROP INDEX IDX_B638C92C76C50E4A ON gite');
        $this->addSql('ALTER TABLE gite CHANGE proprietaire_id propritaire_id INT NOT NULL');
        $this->addSql('ALTER TABLE gite ADD CONSTRAINT FK_B638C92C7B2EEE88 FOREIGN KEY (propritaire_id) REFERENCES proprietaire (id)');
        $this->addSql('CREATE INDEX IDX_B638C92C7B2EEE88 ON gite (propritaire_id)');
    }
}
