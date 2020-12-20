<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201122165033 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE caissier (id INT AUTO_INCREMENT NOT NULL, userù_id INT NOT NULL, UNIQUE INDEX UNIQ_1F038BC2B64944F6 (userù_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE constance (id INT AUTO_INCREMENT NOT NULL, infirmier_id INT NOT NULL, patient_id INT NOT NULL, INDEX IDX_629ACEFFC2BE0752 (infirmier_id), INDEX IDX_629ACEFF6B899279 (patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE docteur (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, specialite_id INT NOT NULL, UNIQUE INDEX UNIQ_83A7A439A76ED395 (user_id), INDEX IDX_83A7A4392195E0F0 (specialite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE infirmier (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, UNIQUE INDEX UNIQ_BFEC55B9A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maladie (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordenance (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, UNIQUE INDEX UNIQ_1ADAD7EBA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialite (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, caissier_id INT NOT NULL, patient_id INT NOT NULL, type_visite_id INT NOT NULL, created_at DATETIME NOT NULL, montant INT NOT NULL, INDEX IDX_97A0ADA3B514973B (caissier_id), INDEX IDX_97A0ADA36B899279 (patient_id), INDEX IDX_97A0ADA375039D49 (type_visite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_visite (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, cni VARCHAR(255) NOT NULL, date_naiss DATETIME NOT NULL, telephone VARCHAR(14) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visite (id INT AUTO_INCREMENT NOT NULL, patient_id INT DEFAULT NULL, docteur_id INT NOT NULL, ordenance_id INT DEFAULT NULL, date_visite VARCHAR(255) NOT NULL, rv DATETIME DEFAULT NULL, note LONGTEXT NOT NULL, INDEX IDX_B09C8CBB6B899279 (patient_id), INDEX IDX_B09C8CBBCF22540A (docteur_id), UNIQUE INDEX UNIQ_B09C8CBBD89133B9 (ordenance_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE caissier ADD CONSTRAINT FK_1F038BC2B64944F6 FOREIGN KEY (userù_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE constance ADD CONSTRAINT FK_629ACEFFC2BE0752 FOREIGN KEY (infirmier_id) REFERENCES infirmier (id)');
        $this->addSql('ALTER TABLE constance ADD CONSTRAINT FK_629ACEFF6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE docteur ADD CONSTRAINT FK_83A7A439A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE docteur ADD CONSTRAINT FK_83A7A4392195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id)');
        $this->addSql('ALTER TABLE infirmier ADD CONSTRAINT FK_BFEC55B9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3B514973B FOREIGN KEY (caissier_id) REFERENCES caissier (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA36B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA375039D49 FOREIGN KEY (type_visite_id) REFERENCES type_visite (id)');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBB6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBBCF22540A FOREIGN KEY (docteur_id) REFERENCES docteur (id)');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBBD89133B9 FOREIGN KEY (ordenance_id) REFERENCES ordenance (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3B514973B');
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBBCF22540A');
        $this->addSql('ALTER TABLE constance DROP FOREIGN KEY FK_629ACEFFC2BE0752');
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBBD89133B9');
        $this->addSql('ALTER TABLE constance DROP FOREIGN KEY FK_629ACEFF6B899279');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA36B899279');
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBB6B899279');
        $this->addSql('ALTER TABLE docteur DROP FOREIGN KEY FK_83A7A4392195E0F0');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA375039D49');
        $this->addSql('ALTER TABLE caissier DROP FOREIGN KEY FK_1F038BC2B64944F6');
        $this->addSql('ALTER TABLE docteur DROP FOREIGN KEY FK_83A7A439A76ED395');
        $this->addSql('ALTER TABLE infirmier DROP FOREIGN KEY FK_BFEC55B9A76ED395');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EBA76ED395');
        $this->addSql('DROP TABLE caissier');
        $this->addSql('DROP TABLE constance');
        $this->addSql('DROP TABLE docteur');
        $this->addSql('DROP TABLE infirmier');
        $this->addSql('DROP TABLE maladie');
        $this->addSql('DROP TABLE ordenance');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE specialite');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('DROP TABLE type_visite');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE visite');
    }
}
