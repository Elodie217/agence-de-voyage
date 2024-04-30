<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240426143536 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adv_utilisateur DROP FOREIGN KEY FK_9B0229A5D60322AC');
        $this->addSql('DROP INDEX UNIQ_9B0229A5BDC1F04 ON adv_utilisateur');
        $this->addSql('DROP INDEX IDX_9B0229A5D60322AC ON adv_utilisateur');
        $this->addSql('ALTER TABLE adv_utilisateur ADD email VARCHAR(180) NOT NULL, ADD roles JSON NOT NULL, ADD password VARCHAR(255) NOT NULL, ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD telephone VARCHAR(15) DEFAULT NULL, DROP role_id, DROP nom_utilisateur, DROP prenom_utilisateur, DROP email_utilisateur, DROP telephone_utilisateur, DROP motdepasse_utilisateur');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON adv_utilisateur (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_IDENTIFIER_EMAIL ON adv_utilisateur');
        $this->addSql('ALTER TABLE adv_utilisateur ADD role_id INT DEFAULT NULL, ADD nom_utilisateur VARCHAR(255) NOT NULL, ADD prenom_utilisateur VARCHAR(255) NOT NULL, ADD email_utilisateur VARCHAR(255) NOT NULL, ADD telephone_utilisateur VARCHAR(255) NOT NULL, ADD motdepasse_utilisateur VARCHAR(255) DEFAULT NULL, DROP email, DROP roles, DROP password, DROP nom, DROP prenom, DROP telephone');
        $this->addSql('ALTER TABLE adv_utilisateur ADD CONSTRAINT FK_9B0229A5D60322AC FOREIGN KEY (role_id) REFERENCES adv_role (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9B0229A5BDC1F04 ON adv_utilisateur (email_utilisateur)');
        $this->addSql('CREATE INDEX IDX_9B0229A5D60322AC ON adv_utilisateur (role_id)');
    }
}
