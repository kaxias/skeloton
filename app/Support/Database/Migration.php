<?php

namespace App\Support\Database;

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Builder;
use Phinx\Migration\AbstractMigration;

class Migration extends AbstractMigration
{
    protected Builder $schema;

    public function init(): void
    {
        $this->schema = Manager::schema();
    }
}
