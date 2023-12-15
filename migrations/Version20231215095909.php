<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231215095909 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Insertion table Recette ';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '4','4','40');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '5','5','40');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '5','4','40');");

    }

    public function down(Schema $schema): void
    {
        $this->addSql("DELETE FROM recette WHERE `produit_id` = '4'and `ingredient_id` = '4';");
        $this->addSql("DELETE FROM recette WHERE `produit_id` = '5'and `ingredient_id` = '5';");
        $this->addSql("DELETE FROM recette WHERE `produit_id` = '5' and `ingredient_id` = '4';");
    }
}
