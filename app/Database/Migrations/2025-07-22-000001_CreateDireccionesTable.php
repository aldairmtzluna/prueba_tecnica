<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDireccionesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'usuario_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false
            ],
            'codigo_postal' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'null' => false
            ],
            'colonia' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'municipio' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'estado' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false
            ]
        ]);
        
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('direcciones');
    }

    public function down()
    {
        $this->forge->dropTable('direcciones');
    }
}