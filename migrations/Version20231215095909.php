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
        return 'Insertion table User (role : admin) ';
    }

    public function up(Schema $schema): void
    {
        $hashedPassword = password_hash('adminadmin', PASSWORD_BCRYPT);
        $this->addSql("INSERT INTO user (`email`, `roles`, `password`, `prenom`, `num_tel`, `adresse`, `nom`) VALUES ( 'admin@gmail.com','[\"ROLE_ADMIN\"]','$hashedPassword','pauline','06-57-73-27-91','1 chemin de la rue','TRONTIN');");

    }

    public function down(Schema $schema): void
    {
        $this->addSql("DELETE FROM user WHERE `prenom` = 'pauline';");
    }
}
