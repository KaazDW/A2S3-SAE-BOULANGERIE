<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240111125606 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facture_produit DROP FOREIGN KEY FK_61424D7EAABEFE2C');
        $this->addSql('ALTER TABLE facture_produit DROP FOREIGN KEY FK_61424D7EDAA76EDF');
        $this->addSql('DROP INDEX IDX_61424D7EAABEFE2C ON facture_produit');
        $this->addSql('DROP INDEX IDX_61424D7EDAA76EDF ON facture_produit');
        $this->addSql('ALTER TABLE facture_produit ADD id_facture INT NOT NULL, DROP id_facture_id, CHANGE id_produit_id id_produit INT NOT NULL');
        $this->addSql('ALTER TABLE facture_produit ADD CONSTRAINT FK_61424D7EF7384557 FOREIGN KEY (id_produit) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE facture_produit ADD CONSTRAINT FK_61424D7E201BCD60 FOREIGN KEY (id_facture) REFERENCES facture (id)');
        $this->addSql('CREATE INDEX IDX_61424D7EF7384557 ON facture_produit (id_produit)');
        $this->addSql('CREATE INDEX IDX_61424D7E201BCD60 ON facture_produit (id_facture)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facture_produit DROP FOREIGN KEY FK_61424D7EF7384557');
        $this->addSql('ALTER TABLE facture_produit DROP FOREIGN KEY FK_61424D7E201BCD60');
        $this->addSql('DROP INDEX IDX_61424D7EF7384557 ON facture_produit');
        $this->addSql('DROP INDEX IDX_61424D7E201BCD60 ON facture_produit');
        $this->addSql('ALTER TABLE facture_produit ADD id_produit_id INT NOT NULL, ADD id_facture_id INT DEFAULT NULL, DROP id_produit, DROP id_facture');
        $this->addSql('ALTER TABLE facture_produit ADD CONSTRAINT FK_61424D7EAABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produit (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE facture_produit ADD CONSTRAINT FK_61424D7EDAA76EDF FOREIGN KEY (id_facture_id) REFERENCES facture (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_61424D7EAABEFE2C ON facture_produit (id_produit_id)');
        $this->addSql('CREATE INDEX IDX_61424D7EDAA76EDF ON facture_produit (id_facture_id)');
    }
}
