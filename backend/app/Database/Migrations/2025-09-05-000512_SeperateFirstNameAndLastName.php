<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SeperateFirstNameAndLastName extends Migration
{
    public function up()
    {
        // Add nullable first_name and last_name columns
        $fields = [
            'first_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'after' => 'name',
            ],
            'last_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'after' => 'first_name',
            ],
        ];

        // Add columns
        $this->forge->addColumn('funeral_requests', $fields);

        // Populate new columns from existing `name` column (simple split by first space)
        // MySQL: first_name = SUBSTRING_INDEX(name, ' ', 1)
        // last_name = NULL if single token, otherwise the remainder after first space
        $sql = "UPDATE funeral_requests
            SET first_name = SUBSTRING_INDEX(name, ' ', 1),
                last_name = NULLIF(TRIM(SUBSTRING(name, LENGTH(SUBSTRING_INDEX(name,' ',1)) + 2)), '')";

        $this->db->query($sql);

        // Remove the old `name` column after migration
        $this->forge->dropColumn('funeral_requests', 'name');
    }

    public function down()
    {
    // Restore `name` from first_name/last_name (if name is empty) and drop the columns
    // Concatenate first and last into name where appropriate
    $this->db->query("UPDATE funeral_requests SET name = CONCAT_WS(' ', first_name, last_name) WHERE COALESCE(name,'') = '' OR name IS NULL");

    // Drop added columns
    $this->forge->dropColumn('funeral_requests', ['first_name', 'last_name']);
    }
}
