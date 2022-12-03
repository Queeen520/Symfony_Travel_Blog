<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221130205051 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entries ADD fk_recommend_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entries ADD CONSTRAINT FK_2DF8B3C5F800A39D FOREIGN KEY (fk_recommend_id) REFERENCES recommend (id)');
        $this->addSql('CREATE INDEX IDX_2DF8B3C5F800A39D ON entries (fk_recommend_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entries DROP FOREIGN KEY FK_2DF8B3C5F800A39D');
        $this->addSql('DROP INDEX IDX_2DF8B3C5F800A39D ON entries');
        $this->addSql('ALTER TABLE entries DROP fk_recommend_id');
    }
}
