<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserItem extends Migration
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
            'items_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'price' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => true,
            ],
            'buyer_id' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'product_id' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'qty' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => true,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('userItems');
    }

    public function down()
    {
        //
    }
}
