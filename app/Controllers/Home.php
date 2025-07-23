<?php
namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\DireccionModel;

class Home extends BaseController
{
    protected $db;
    protected $usuarioModel;
    protected $direccionModel;
    
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->usuarioModel = new UsuarioModel();
        $this->direccionModel = new DireccionModel();
    }
    
    public function index()
    {
        return $this->renderView('view_main');
    }

    public function agregarUsuario()
    {
        $data = [];
        
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'nombre' => 'required|min_length[3]|max_length[50]',
                'apellidos' => 'required|min_length[3]|max_length[100]',
                'sexo' => 'required|in_list[Masculino,Femenino,Otro]',
                'email' => 'required|valid_email|is_unique[usuarios.email]',
                'telefono' => 'required|min_length[10]|max_length[15]',
                'codigo_postal' => 'required|exact_length[5]|numeric',
                'colonia' => 'required',
                'municipio' => 'required',
                'estado' => 'required',
                'tipo_usuario' => 'required|in_list[Administrativo,Administrativo-Operativo,Operativo]'
            ];
            
            if ($this->validate($rules)) {
                $this->db->transStart();
                
                try {
                    $postData = $this->request->getPost();
                    
                    $usuarioId = $this->usuarioModel->insert($postData);
                    
                    if (!$usuarioId) {
                        throw new \RuntimeException('Error al guardar el usuario');
                    }
                    
                    $direccionData = [
                        'usuario_id' => $usuarioId,
                        'codigo_postal' => $postData['codigo_postal'],
                        'colonia' => $postData['colonia'],
                        'municipio' => $postData['municipio'],
                        'estado' => $postData['estado']
                    ];
                    
                    if (!$this->direccionModel->insert($direccionData)) {
                        throw new \RuntimeException('Error al guardar la dirección');
                    }
                    
                    $this->db->transComplete();
                    
                    return redirect()->to('/reportes')->with('success', 'Usuario agregado correctamente');
                    
                } catch (\Exception $e) {
                    $this->db->transRollback();
                    log_message('error', 'Error al agregar usuario: ' . $e->getMessage());
                    return redirect()->back()->withInput()->with('error', 'Error al guardar los datos: ' . $e->getMessage());
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        
        return $this->renderView('usuarios/agregar', $data);
    }
    
    public function verUsuario($id)
    {
        $usuario = $this->usuarioModel->find($id);
        
        if (!$usuario) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Usuario no encontrado');
        }
        
        $direccion = $this->direccionModel->where('usuario_id', $id)->first();
        
        $data = [
            'usuario' => $usuario,
            'direccion' => $direccion
        ];
        
        return $this->renderView('usuarios/ver', $data);
    }

    public function editarUsuario($id)
    {
        $usuario = $this->usuarioModel->find($id);
        
        if (!$usuario) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Usuario no encontrado');
        }
        
        $direccion = $this->direccionModel->where('usuario_id', $id)->first();
        
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'nombre' => 'required|min_length[3]|max_length[50]',
                'apellidos' => 'required|min_length[3]|max_length[100]',
                'sexo' => 'required|in_list[Masculino,Femenino,Otro]',
                'email' => 'required|valid_email|is_unique[usuarios.email,id,'.$id.']',
                'telefono' => 'required|min_length[10]|max_length[15]',
                'codigo_postal' => 'required|exact_length[5]|numeric',
                'colonia' => 'required',
                'municipio' => 'required',
                'estado' => 'required',
                'tipo_usuario' => 'required|in_list[Administrativo,Administrativo-Operativo,Operativo]'
            ];
            
            if ($this->validate($rules)) {
                $this->db->transStart();
                
                try {
                    $postData = $this->request->getPost();
                    
                    // Actualizar usuario
                    $this->usuarioModel->update($id, $postData);
                    
                    $direccionData = [
                        'codigo_postal' => $postData['codigo_postal'],
                        'colonia' => $postData['colonia'],
                        'municipio' => $postData['municipio'],
                        'estado' => $postData['estado']
                    ];
                    
                    if ($direccion) {
                        $this->direccionModel->update($direccion['id'], $direccionData);
                    } else {
                        $direccionData['usuario_id'] = $id;
                        $this->direccionModel->insert($direccionData);
                    }
                    
                    $this->db->transComplete();
                    
                    return redirect()->to('/ver-usuario/'.$id)->with('success', 'Usuario actualizado correctamente');
                    
                } catch (\Exception $e) {
                    $this->db->transRollback();
                    log_message('error', 'Error al actualizar usuario: ' . $e->getMessage());
                    return redirect()->back()->withInput()->with('error', 'Error al actualizar los datos: ' . $e->getMessage());
                }
            } else {
                return redirect()->back()->withInput()->with('validation', $this->validator);
            }
        }
        
        $data = [
            'usuario' => $usuario,
            'direccion' => $direccion,
            'validation' => session()->getFlashdata('validation')
        ];
        
        return $this->renderView('usuarios/editar', $data);
    }

    public function cambiarEstatus($id)
    {

        $usuario = $this->usuarioModel->find($id);
        
        if (!$usuario) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ]);
        }
        
        $nuevoEstatus = $usuario['estatus'] === 'Activo' ? 'Inactivo' : 'Activo';
        
        if ($this->usuarioModel->update($id, ['estatus' => $nuevoEstatus])) {
            return $this->response->setJSON([
                'success' => true,
                'nuevoEstatus' => $nuevoEstatus,
                'textoBoton' => $nuevoEstatus === 'Activo' ? 'Desactivar' : 'Activar'
            ]);
        }
        
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Error al cambiar el estatus'
        ]);
    }

    public function reportes()
    {
        $usuarios = $this->usuarioModel->findAll();
        return $this->renderView('usuarios/reportes', ['usuarios' => $usuarios]);
    }


    public function exportarExcel()
    {
        $usuarios = $this->usuarioModel->findAll();
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="reporte_usuarios.xls"');
        
        echo '<table>';
        echo '<tr><th>ID</th><th>Nombre</th><th>Email</th><th>Teléfono</th><th>Tipo</th><th>Estatus</th></tr>';
        
        foreach ($usuarios as $usuario) {
            echo '<tr>';
            echo '<td>' . $usuario['id'] . '</td>';
            echo '<td>' . $usuario['nombre'] . ' ' . $usuario['apellidos'] . '</td>';
            echo '<td>' . $usuario['email'] . '</td>';
            echo '<td>' . $usuario['telefono'] . '</td>';
            echo '<td>' . $usuario['tipo_usuario'] . '</td>';
            echo '<td>' . $usuario['estatus'] . '</td>';
            echo '</tr>';
        }
        
        echo '</table>';
        exit();
    }

    public function buscarCp($cp)
    {
        try {
            if (strlen($cp) !== 5 || !is_numeric($cp)) {
                return $this->response->setJSON(['error' => 'El código postal debe tener 5 dígitos']);
            }
    
            $client = \Config\Services::curlrequest([
                'timeout' => 10,
                'verify' => false
            ]);
            $response = $client->get("https://api.copomex.com/query/info_cp/$cp", [
                'query' => [
                    'type' => 'simplified',
                    'token' => 'c7de37b7-655e-4ae6-bebb-fd44251f6e4f'
                ],
                'headers' => [
                    'Accept' => 'application/json'
                ]
            ]);
            
            $data = json_decode($response->getBody(), true);
            
            if ($data['error'] ?? true) {
                return $this->response->setJSON([
                    'error' => $data['error_message'] ?? 'Error en la respuesta de la API'
                ]);
            }
            
            return $this->response->setJSON([
                'colonias' => $data['response']['asentamiento'] ?? [],
                'municipio' => $data['response']['municipio'] ?? '',
                'estado' => $data['response']['estado'] ?? ''
            ]);
            
        } catch (\Exception $e) {
            log_message('error', 'Error API CP: ' . $e->getMessage());
            return $this->response->setJSON([
                'error' => 'No se pudo conectar con el servicio de códigos postales'
            ]);
        }
    }
}