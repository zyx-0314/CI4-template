<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateServiceTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
                'null' => false,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            // CSV style list of inclusions (store as TEXT for flexibility)
            'inclusions' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'cost' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => false,
                'default' => '0.00',
            ],
            'banner_image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            // Flags
            'is_active' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1, // 1 = active, 0 = inactive
                'null' => false,
            ],
            'is_available' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1, // 1 = available, 0 = currently not available
                'null' => false,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('services', true);
    }

    public function down()
    {
        $this->forge->dropTable('services', true);
    }
}
