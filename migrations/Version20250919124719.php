<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250919124719 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE burger_image DROP FOREIGN KEY FK_E74C553C17CE5090');
        $this->addSql('ALTER TABLE burger_image DROP FOREIGN KEY FK_E74C553C3DA5256D');
        $this->addSql('DROP TABLE burger_image');
        $this->addSql('ALTER TABLE burger ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE burger ADD CONSTRAINT FK_EFE35A0D3DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EFE35A0D3DA5256D ON burger (image_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE burger_image (burger_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_E74C553C17CE5090 (burger_id), INDEX IDX_E74C553C3DA5256D (image_id), PRIMARY KEY(burger_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE burger_image ADD CONSTRAINT FK_E74C553C17CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE burger_image ADD CONSTRAINT FK_E74C553C3DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE burger DROP FOREIGN KEY FK_EFE35A0D3DA5256D');
        $this->addSql('DROP INDEX UNIQ_EFE35A0D3DA5256D ON burger');
        $this->addSql('ALTER TABLE burger DROP image_id');
    }
}
