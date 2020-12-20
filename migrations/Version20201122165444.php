<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201122165444 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE caissier DROP FOREIGN KEY FK_1F038BC2B64944F6');
        $this->addSql('DROP INDEX UNIQ_1F038BC2B64944F6 ON caissier');
        $this->addSql('ALTER TABLE caissier CHANGE userù_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE caissier ADD CONSTRAINT FK_1F038BC2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1F038BC2A76ED395 ON caissier (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE caissier DROP FOREIGN KEY FK_1F038BC2A76ED395');
        $this->addSql('DROP INDEX UNIQ_1F038BC2A76ED395 ON caissier');
        $this->addSql('ALTER TABLE caissier CHANGE user_id userù_id INT NOT NULL');
        $this->addSql('ALTER TABLE caissier ADD CONSTRAINT FK_1F038BC2B64944F6 FOREIGN KEY (userù_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1F038BC2B64944F6 ON caissier (userù_id)');
    }
}
