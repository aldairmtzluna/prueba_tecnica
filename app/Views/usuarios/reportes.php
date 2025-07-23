<div class="container">
    <h2>Reporte de Usuarios</h2>
    
    <div class="mb-3">
        <a href="<?= base_url('exportar-excel') ?>" class="btn btn-success">Exportar a Excel</a>
    </div>
    
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= $usuario['id'] ?></td>
                    <td><?= $usuario['nombre'] . ' ' . $usuario['apellidos'] ?></td>
                    <td><?= $usuario['email'] ?></td>
                    <td>
                        <span class="badge <?= $usuario['estatus'] === 'Activo' ? 'bg-success' : 'bg-secondary' ?>">
                            <?= $usuario['estatus'] ?>
                        </span>
                    </td>
                    <td>
                        <a href="<?= base_url('ver-usuario/' . $usuario['id']) ?>" class="btn btn-sm btn-info">Ver</a>
                        <a href="<?= base_url('editar-usuario/' . $usuario['id']) ?>" class="btn btn-sm btn-warning">Editar</a>
                        <button class="btn btn-sm <?= $usuario['estatus'] === 'Activo' ? 'btn-danger' : 'btn-success' ?> cambiar-estatus"
                                data-id="<?= $usuario['id'] ?>"
                                data-bs-toggle="modal" 
                                data-bs-target="#confirmModal">
                            <?= $usuario['estatus'] === 'Activo' ? 'Desactivar' : 'Activar' ?>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal de confirmación -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirmar cambio de estatus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro que deseas cambiar el estatus de este usuario?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="confirmChange">Confirmar</button>
            </div>
        </div>
    </div>
</div>

