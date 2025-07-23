<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateUsuariosTable extends Migration
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
            'nombre' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false
            ],
            'apellidos' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'sexo' => [
                'type' => 'ENUM',
                'constraint' => ['Masculino','Femenino','Otro'],
                'null' => false
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
                'unique' => true
            ],
            'telefono' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
                'null' => false
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],
            'tipo_usuario' => [
                'type' => 'ENUM',
                'constraint' => ['Administrativo','Administrativo-Operativo','Operativo'],
                'null' => false
            ],
            'estatus' => [
                'type' => 'ENUM',
                'constraint' => ['Activo','Inactivo'],
                'default' => 'Activo'
            ],
            'fecha_registro' => [
                'type' => 'DATETIME',
                'null' => false,
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ],
        ]);
        
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('usuarios');
    }

    public function down()
    {
        $this->forge->dropTable('usuarios');
    }
}