<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240111093207 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facture_produit ADD CONSTRAINT FK_61424D7E201BCD60 FOREIGN KEY (id_facture) REFERENCES facture (id)');
        $this->addSql('CREATE INDEX IDX_61424D7E201BCD60 ON facture_produit (id_facture)');
        $this->addSql('ALTER TABLE facture_produit RENAME INDEX fk_61424d7ef7384557 TO IDX_61424D7EF7384557');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facture_produit DROP FOREIGN KEY FK_61424D7E201BCD60');
        $this->addSql('DROP INDEX IDX_61424D7E201BCD60 ON facture_produit');
        $this->addSql('ALTER TABLE facture_produit RENAME INDEX idx_61424d7ef7384557 TO FK_61424D7EF7384557');
    }
}
