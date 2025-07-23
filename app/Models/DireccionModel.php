<?php
namespace App\Models;

use CodeIgniter\Model;

class DireccionModel extends Model
{
    protected $table = 'direcciones';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'usuario_id', 'codigo_postal', 'colonia', 'municipio', 'estado'
    ];
}