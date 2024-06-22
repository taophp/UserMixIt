<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240622140241 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE greeting_id_seq CASCADE');
        $this->addSql('CREATE TABLE comment (id UUID NOT NULL, author_id UUID NOT NULL, request_id UUID NOT NULL, content TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9474526CF675F31B ON comment (author_id)');
        $this->addSql('CREATE INDEX IDX_9474526C427EB8A5 ON comment (request_id)');
        $this->addSql('COMMENT ON COLUMN comment.id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN comment.author_id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN comment.request_id IS \'(DC2Type:ulid)\'');
        $this->addSql('CREATE TABLE project (id UUID NOT NULL, owner_id UUID NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2FB3D0EE7E3C61F9 ON project (owner_id)');
        $this->addSql('COMMENT ON COLUMN project.id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN project.owner_id IS \'(DC2Type:ulid)\'');
        $this->addSql('CREATE TABLE request (id UUID NOT NULL, author_id UUID NOT NULL, project_id UUID NOT NULL, title VARCHAR(255) NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3B978F9FF675F31B ON request (author_id)');
        $this->addSql('CREATE INDEX IDX_3B978F9F166D1F9C ON request (project_id)');
        $this->addSql('COMMENT ON COLUMN request.id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN request.author_id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN request.project_id IS \'(DC2Type:ulid)\'');
        $this->addSql('CREATE TABLE "user" (id UUID NOT NULL, name VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_NAME ON "user" (name)');
        $this->addSql('COMMENT ON COLUMN "user".id IS \'(DC2Type:ulid)\'');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C427EB8A5 FOREIGN KEY (request_id) REFERENCES request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE7E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE request ADD CONSTRAINT FK_3B978F9FF675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE request ADD CONSTRAINT FK_3B978F9F166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE greeting');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE greeting_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE greeting (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526CF675F31B');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526C427EB8A5');
        $this->addSql('ALTER TABLE project DROP CONSTRAINT FK_2FB3D0EE7E3C61F9');
        $this->addSql('ALTER TABLE request DROP CONSTRAINT FK_3B978F9FF675F31B');
        $this->addSql('ALTER TABLE request DROP CONSTRAINT FK_3B978F9F166D1F9C');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE request');
        $this->addSql('DROP TABLE "user"');
    }
}
