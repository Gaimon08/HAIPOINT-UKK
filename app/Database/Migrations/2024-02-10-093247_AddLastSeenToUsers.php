<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLastSeenToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'last_seen' => ['type' => 'datetime', 'null' => true],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'last_seen');
    }
}
