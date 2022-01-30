<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220130182707 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_genre (article_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_F4E741E97294869C (article_id), INDEX IDX_F4E741E94296D31F (genre_id), PRIMARY KEY(article_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genres (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_genre ADD CONSTRAINT FK_F4E741E97294869C FOREIGN KEY (article_id) REFERENCES articles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_genre ADD CONSTRAINT FK_F4E741E94296D31F FOREIGN KEY (genre_id) REFERENCES genres (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE articles CHANGE age_rating age_rating enum(\'G\', \'PG\', \'PG-13\', \'PG-17+\', \'R+\'), CHANGE type type enum(\'anime\', \'manga\', \'ranobe\')');
        $this->addSql('ALTER TABLE articles_source_pages CHANGE source_alias source_alias enum(\'shikimori\', \'yamianime\', \'anivisual\'), CHANGE type type enum(\'anime\', \'manga\', \'ranobe\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_genre DROP FOREIGN KEY FK_F4E741E94296D31F');
        $this->addSql('DROP TABLE article_genre');
        $this->addSql('DROP TABLE genres');
        $this->addSql('ALTER TABLE articles CHANGE age_rating age_rating VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE articles_source_pages CHANGE source_alias source_alias VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
