<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateObituaryTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'first_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'middle_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'last_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'date_of_birth' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'date_of_death' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'profile_image' => [
                'type'       => 'VARCHAR',
                'constraint' => 1024,
                'null'       => true,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'viewing_date_time' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'viewing_place' => [
                'type'       => 'VARCHAR',
                'constraint' => 512,
                'null'       => true,
            ],
            'funeral_date_time' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'funeral_place' => [
                'type'       => 'VARCHAR',
                'constraint' => 512,
                'null'       => true,
            ],
            'burial_date_time' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'burial_place' => [
                'type'       => 'VARCHAR',
                'constraint' => 512,
                'null'       => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
                'default'    => 'request',
            ],
            'obituary_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            // JSON-style string columns (store as TEXT), optional
            'treasured_memories' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'family' => [
                'type' => 'TEXT',
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
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('obituaryrequests', true);
    }

    public function down()
    {
        $this->forge->dropTable('obituaryrequests', true);
    }
}
