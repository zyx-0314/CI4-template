<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ConnectRequestToUsersAndServices extends Migration
{
    public function up()
    {
        // Add foreign key from requests.user_id -> users.id (nullable, set null on delete)
        // and requests.service_id -> services.id (restrict delete)
        $this->forge->addForeignKey('user_id', 'users', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('service_id', 'services', 'id', 'RESTRICT', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropForeignKey('requests', 'user_id');
        $this->forge->dropForeignKey('requests', 'service_id');
    }
}
