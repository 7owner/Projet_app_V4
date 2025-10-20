<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Add missing column motif_blocage on maintenance
 */
final class Version20251020163210 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add motif_blocage column to maintenance table if missing';
    }

    public function up(Schema $schema): void
    {
        $sm = $this->connection->createSchemaManager();
        if (!$sm->tablesExist(['maintenance'])) {
            return; // table absent; nothing to do
        }

        $hasColumn = false;
        foreach ($sm->listTableColumns('maintenance') as $col) {
            if (strtolower($col->getName()) === 'motif_blocage') {
                $hasColumn = true;
                break;
            }
        }

        if (!$hasColumn) {
            $this->addSql('ALTER TABLE maintenance ADD motif_blocage TEXT DEFAULT NULL');
        }
    }

    public function down(Schema $schema): void
    {
        $sm = $this->connection->createSchemaManager();
        if (!$sm->tablesExist(['maintenance'])) {
            return;
        }

        $hasColumn = false;
        foreach ($sm->listTableColumns('maintenance') as $col) {
            if (strtolower($col->getName()) === 'motif_blocage') {
                $hasColumn = true;
                break;
            }
        }

        if ($hasColumn) {
            $this->addSql('ALTER TABLE maintenance DROP COLUMN motif_blocage');
        }
    }
}

