<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class AddForeignKeyToDirecciones extends Migration
{
    public function up()
    {
        // Verificar si la tabla direcciones existe
        if ($this->forge->getConnection()->tableExists('direcciones')) {
            $this->forge->addForeignKey(
                'usuario_id',
                'usuarios',
                'id',
                'CASCADE',
                'CASCADE',
                'fk_direcciones_usuarios'  // Nombre explícito de la FK
            );
        }
    }

    public function down()
    {
        // Verificar si la tabla existe antes de intentar eliminar la FK
        if ($this->forge->getConnection()->tableExists('direcciones')) {
            try {
                $this->forge->dropForeignKey('direcciones', 'fk_direcciones_usuarios');
            } catch (\Exception $e) {
                // Ignorar error si la FK no existe
            }
        }
    }
}