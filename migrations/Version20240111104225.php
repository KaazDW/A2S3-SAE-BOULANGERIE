<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240111104225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient ADD min_stock DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('UPDATE ingredient SET min_stock = 3 WHERE nom = "Farine de blé"');
        $this->addSql('UPDATE ingredient SET min_stock = 4 WHERE nom = "Farine Blanche"');
        $this->addSql('UPDATE ingredient SET min_stock = NULL WHERE nom = "EAU"');
        $this->addSql('UPDATE ingredient SET min_stock = 2 WHERE nom = "Sucre"');
        $this->addSql('UPDATE ingredient SET min_stock = 1 WHERE nom = "Sel"');
    }


    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('UPDATE ingredient SET min_stock = NULL WHERE nom = "Farine de blé"');
        $this->addSql('UPDATE ingredient SET min_stock = NULL WHERE nom = "Farine Blanche"');
        $this->addSql('UPDATE ingredient SET min_stock = NULL WHERE nom = "EAU"');
        $this->addSql('UPDATE ingredient SET min_stock = NULL WHERE nom = "Sucre"');
        $this->addSql('UPDATE ingredient SET min_stock = NULL WHERE nom = "Sel"');

        // Supprimer la colonne min_stock
        $this->addSql('ALTER TABLE ingredient DROP min_stock');
    }
}
