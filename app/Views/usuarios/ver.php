<div class="container">
    <h2>Detalles del Usuario</h2>
    
    <div class="card">
        <div class="card-header">
            <h4>Información Básica</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nombre:</strong> <?= $usuario['nombre'] ?></p>
                    <p><strong>Apellidos:</strong> <?= $usuario['apellidos'] ?></p>
                    <p><strong>Sexo:</strong> <?= $usuario['sexo'] ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Email:</strong> <?= $usuario['email'] ?></p>
                    <p><strong>Teléfono:</strong> <?= $usuario['telefono'] ?></p>
                    <p><strong>Tipo de usuario:</strong> <?= $usuario['tipo_usuario'] ?></p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card mt-3">
        <div class="card-header">
            <h4>Dirección</h4>
        </div>
        <div class="card-body">
            <?php if ($direccion): ?>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Código Postal:</strong> <?= $direccion['codigo_postal'] ?></p>
                        <p><strong>Colonia:</strong> <?= $direccion['colonia'] ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Municipio/Delegación:</strong> <?= $direccion['municipio'] ?></p>
                        <p><strong>Estado:</strong> <?= $direccion['estado'] ?></p>
                    </div>
                </div>
            <?php else: ?>
                <p class="text-muted">No se encontró información de dirección</p>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="mt-3">
        <a href="<?= base_url('reportes') ?>" class="btn btn-secondary">Volver al listado</a>
        <a href="<?= base_url('editar-usuario/'.$usuario['id']) ?>" class="btn btn-primary">Editar</a>
    </div>
</div>