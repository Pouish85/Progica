<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230523070447 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, adresse VARCHAR(255) NOT NULL, telephone VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE departement (id INT AUTO_INCREMENT NOT NULL, region_id INT NOT NULL, nom VARCHAR(200) NOT NULL, INDEX IDX_C1765B6398260155 (region_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement_exterieur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(200) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement_interieur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(200) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gite (id INT AUTO_INCREMENT NOT NULL, ville_id INT NOT NULL, proprietaire_id INT NOT NULL, contact_id INT NOT NULL, prix_id INT NOT NULL, nom_gite VARCHAR(255) NOT NULL, surface DOUBLE PRECISION NOT NULL, nb_chambres INT NOT NULL, nb_lits INT NOT NULL, accept_animaux TINYINT(1) NOT NULL, tarif_animaux NUMERIC(7, 2) DEFAULT NULL, image LONGTEXT NOT NULL, INDEX IDX_B638C92CA73F0036 (ville_id), INDEX IDX_B638C92C7B2EEE88 (proprietaire_id), INDEX IDX_B638C92CE7A1254A (contact_id), INDEX IDX_B638C92C944722F2 (prix_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gite_equipement_interieur (gite_id INT NOT NULL, equipement_interieur_id INT NOT NULL, INDEX IDX_9CEB14C1652CAE9B (gite_id), INDEX IDX_9CEB14C1D4593AB1 (equipement_interieur_id), PRIMARY KEY(gite_id, equipement_interieur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gite_equipement_exterieur (gite_id INT NOT NULL, equipement_exterieur_id INT NOT NULL, INDEX IDX_C00BDF79652CAE9B (gite_id), INDEX IDX_C00BDF79971079B8 (equipement_exterieur_id), PRIMARY KEY(gite_id, equipement_exterieur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gite_service (gite_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_1527AE9A652CAE9B (gite_id), INDEX IDX_1527AE9AED5CA9E6 (service_id), PRIMARY KEY(gite_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prix (id INT AUTO_INCREMENT NOT NULL, debut DATE NOT NULL, fin DATE NOT NULL, tarif NUMERIC(7, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proprietaire (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, adresse VARCHAR(255) NOT NULL, telephone VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, departement_id INT NOT NULL, nom VARCHAR(200) NOT NULL, INDEX IDX_43C3D9C3CCF9E01E (departement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE departement ADD CONSTRAINT FK_C1765B6398260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE gite ADD CONSTRAINT FK_B638C92CA73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE gite ADD CONSTRAINT FK_B638C92C7B2EEE88 FOREIGN KEY (proprietaire_id) REFERENCES proprietaire (id)');
        $this->addSql('ALTER TABLE gite ADD CONSTRAINT FK_B638C92CE7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
        $this->addSql('ALTER TABLE gite ADD CONSTRAINT FK_B638C92C944722F2 FOREIGN KEY (prix_id) REFERENCES prix (id)');
        $this->addSql('ALTER TABLE gite_equipement_interieur ADD CONSTRAINT FK_9CEB14C1652CAE9B FOREIGN KEY (gite_id) REFERENCES gite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gite_equipement_interieur ADD CONSTRAINT FK_9CEB14C1D4593AB1 FOREIGN KEY (equipement_interieur_id) REFERENCES equipement_interieur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gite_equipement_exterieur ADD CONSTRAINT FK_C00BDF79652CAE9B FOREIGN KEY (gite_id) REFERENCES gite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gite_equipement_exterieur ADD CONSTRAINT FK_C00BDF79971079B8 FOREIGN KEY (equipement_exterieur_id) REFERENCES equipement_exterieur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gite_service ADD CONSTRAINT FK_1527AE9A652CAE9B FOREIGN KEY (gite_id) REFERENCES gite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gite_service ADD CONSTRAINT FK_1527AE9AED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ville ADD CONSTRAINT FK_43C3D9C3CCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE departement DROP FOREIGN KEY FK_C1765B6398260155');
        $this->addSql('ALTER TABLE gite DROP FOREIGN KEY FK_B638C92CA73F0036');
        $this->addSql('ALTER TABLE gite DROP FOREIGN KEY FK_B638C92C7B2EEE88');
        $this->addSql('ALTER TABLE gite DROP FOREIGN KEY FK_B638C92CE7A1254A');
        $this->addSql('ALTER TABLE gite DROP FOREIGN KEY FK_B638C92C944722F2');
        $this->addSql('ALTER TABLE gite_equipement_interieur DROP FOREIGN KEY FK_9CEB14C1652CAE9B');
        $this->addSql('ALTER TABLE gite_equipement_interieur DROP FOREIGN KEY FK_9CEB14C1D4593AB1');
        $this->addSql('ALTER TABLE gite_equipement_exterieur DROP FOREIGN KEY FK_C00BDF79652CAE9B');
        $this->addSql('ALTER TABLE gite_equipement_exterieur DROP FOREIGN KEY FK_C00BDF79971079B8');
        $this->addSql('ALTER TABLE gite_service DROP FOREIGN KEY FK_1527AE9A652CAE9B');
        $this->addSql('ALTER TABLE gite_service DROP FOREIGN KEY FK_1527AE9AED5CA9E6');
        $this->addSql('ALTER TABLE ville DROP FOREIGN KEY FK_43C3D9C3CCF9E01E');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE departement');
        $this->addSql('DROP TABLE equipement_exterieur');
        $this->addSql('DROP TABLE equipement_interieur');
        $this->addSql('DROP TABLE gite');
        $this->addSql('DROP TABLE gite_equipement_interieur');
        $this->addSql('DROP TABLE gite_equipement_exterieur');
        $this->addSql('DROP TABLE gite_service');
        $this->addSql('DROP TABLE prix');
        $this->addSql('DROP TABLE proprietaire');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE ville');
    }
}
