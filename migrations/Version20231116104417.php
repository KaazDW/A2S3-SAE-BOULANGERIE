<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231116104417 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE DEFAULT NULL, lien_image VARCHAR(255) DEFAULT NULL, contenu VARCHAR(500) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, montant DOUBLE PRECISION NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture_produit (id INT AUTO_INCREMENT NOT NULL, id_produit_id INT NOT NULL, id_facture_id INT DEFAULT NULL, quantite INT NOT NULL, INDEX IDX_61424D7EAABEFE2C (id_produit_id), INDEX IDX_61424D7EDAA76EDF (id_facture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_produit (user_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_71A8F22DA76ED395 (user_id), INDEX IDX_71A8F22DF347EFB (produit_id), PRIMARY KEY(user_id, produit_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE facture_produit ADD CONSTRAINT FK_61424D7EAABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE facture_produit ADD CONSTRAINT FK_61424D7EDAA76EDF FOREIGN KEY (id_facture_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE user_produit ADD CONSTRAINT FK_71A8F22DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_produit ADD CONSTRAINT FK_71A8F22DF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facture_produit DROP FOREIGN KEY FK_61424D7EAABEFE2C');
        $this->addSql('ALTER TABLE facture_produit DROP FOREIGN KEY FK_61424D7EDAA76EDF');
        $this->addSql('ALTER TABLE user_produit DROP FOREIGN KEY FK_71A8F22DA76ED395');
        $this->addSql('ALTER TABLE user_produit DROP FOREIGN KEY FK_71A8F22DF347EFB');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE facture_produit');
        $this->addSql('DROP TABLE user_produit');
    }
}
