<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserTransfer extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'value' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('user_transfer', true);
    }

    public function down()
    {
        $this->forge->dropTable('user_transfer', true);
    }
}
