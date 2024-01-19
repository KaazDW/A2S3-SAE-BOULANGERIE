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
        return 'Ajout de la colonne min_stock';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient ADD min_stock DOUBLE PRECISION DEFAULT NULL');
    }


    public function down(Schema $schema): void
    {
        // Supprimer la colonne min_stock
        $this->addSql('ALTER TABLE ingredient DROP min_stock');
    }
}
