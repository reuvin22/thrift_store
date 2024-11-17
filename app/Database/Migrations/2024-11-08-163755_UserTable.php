<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'employee_id' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'employee_name' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'department' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'department' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'age' => [
                'type' => 'INT',
                'constraint' => 3,
                'unsigned' => false,
                'null' => false,
            ],
            'contact_number' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false,
            ],
            'gender' => [
                'type' => 'VARCHAR',
                'constraint' => 6,
                'null' => false,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'role' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => false,
            ],
            'logged_in' => [
                'type' => 'BOOLEAN',
                'null' => false,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => false,
                'update' => 'CURRENT_TIMESTAMP'
            ],
            'deleted_by' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => true,
            ],
            'date_deleted' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                'default' => null,
            ],
            'is_deleted' => [
                'type' => 'BOOLEAN',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        //
    }
}
