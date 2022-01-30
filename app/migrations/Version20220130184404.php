<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220130184404 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles ADD poster_url VARCHAR(255) DEFAULT NULL, CHANGE age_rating age_rating enum(\'G\', \'PG\', \'PG-13\', \'PG-17+\', \'R+\'), CHANGE type type enum(\'anime\', \'manga\', \'ranobe\'), CHANGE status status enum(\'released\', \'anons\', \'ongoing\', \'latest\')');
        $this->addSql('ALTER TABLE articles_source_pages CHANGE source_alias source_alias enum(\'shikimori\', \'yamianime\', \'anivisual\'), CHANGE type type enum(\'anime\', \'manga\', \'ranobe\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP poster_url, CHANGE age_rating age_rating VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE status status VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE articles_source_pages CHANGE source_alias source_alias VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
