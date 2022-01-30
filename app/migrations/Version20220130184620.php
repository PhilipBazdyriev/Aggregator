<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220130184620 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles ADD source_page_id INT DEFAULT NULL, CHANGE age_rating age_rating enum(\'G\', \'PG\', \'PG-13\', \'PG-17+\', \'R+\'), CHANGE type type enum(\'anime\', \'manga\', \'ranobe\'), CHANGE status status enum(\'released\', \'anons\', \'ongoing\', \'latest\')');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD31684599DB8C FOREIGN KEY (source_page_id) REFERENCES articles_source_pages (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BFDD31684599DB8C ON articles (source_page_id)');
        $this->addSql('ALTER TABLE articles_source_pages CHANGE source_alias source_alias enum(\'shikimori\', \'yamianime\', \'anivisual\'), CHANGE type type enum(\'anime\', \'manga\', \'ranobe\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD31684599DB8C');
        $this->addSql('DROP INDEX UNIQ_BFDD31684599DB8C ON articles');
        $this->addSql('ALTER TABLE articles DROP source_page_id, CHANGE age_rating age_rating VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE status status VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE articles_source_pages CHANGE source_alias source_alias VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
