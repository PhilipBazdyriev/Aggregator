<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220204170751 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168319CE0FF');
        $this->addSql('DROP INDEX UNIQ_BFDD3168319CE0FF ON articles');
        $this->addSql('ALTER TABLE articles CHANGE age_rating age_rating enum(\'G\', \'PG\', \'PG-13\', \'PG-17+\', \'R-17\', \'R+\', \'Rx\'), CHANGE type type enum(\'anime\', \'manga\', \'ranobe\'), CHANGE status status enum(\'released\', \'anons\', \'ongoing\', \'latest\'), CHANGE persona_fisica_id source_page INT DEFAULT NULL');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD316815803323 FOREIGN KEY (source_page) REFERENCES articles_source_pages (id) ON DELETE SET NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BFDD316815803323 ON articles (source_page)');
        $this->addSql('ALTER TABLE articles_source_pages CHANGE source_alias source_alias enum(\'yummyanime\', \'shikimori\', \'anivisual\'), CHANGE type type enum(\'anime\', \'manga\', \'ranobe\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD316815803323');
        $this->addSql('DROP INDEX UNIQ_BFDD316815803323 ON articles');
        $this->addSql('ALTER TABLE articles CHANGE age_rating age_rating VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE status status VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE source_page persona_fisica_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168319CE0FF FOREIGN KEY (persona_fisica_id) REFERENCES articles_source_pages (id) ON DELETE SET NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BFDD3168319CE0FF ON articles (persona_fisica_id)');
        $this->addSql('ALTER TABLE articles_source_pages CHANGE source_alias source_alias VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
