<div class="container">
    <h2>Editar Usuario</h2>

    <?php $validation = session('validation'); ?>

    <?= form_open('editar-usuario/'.$usuario['id'], ['class' => 'needs-validation', 'novalidate' => '']) ?>

    <div class="row">
        <div class="col-md-6">
            <h4>Información Básica</h4>

            <div class="form-group mb-3">
                <label for="nombre">Nombre*</label>
                <input type="text" class="form-control <?= $validation && $validation->hasError('nombre') ? 'is-invalid' : '' ?>" 
                       id="nombre" name="nombre" value="<?= old('nombre', $usuario['nombre'] ?? '') ?>" required>
                <?php if ($validation && $validation->hasError('nombre')): ?>
                    <div class="invalid-feedback"><?= $validation->getError('nombre') ?></div>
                <?php else: ?>
                    <div class="invalid-feedback">Por favor ingresa el nombre</div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-3">
                <label for="apellidos">Apellidos*</label>
                <input type="text" class="form-control <?= $validation && $validation->hasError('apellidos') ? 'is-invalid' : '' ?>" 
                       id="apellidos" name="apellidos" value="<?= old('apellidos', $usuario['apellidos'] ?? '') ?>" required>
                <?php if ($validation && $validation->hasError('apellidos')): ?>
                    <div class="invalid-feedback"><?= $validation->getError('apellidos') ?></div>
                <?php else: ?>
                    <div class="invalid-feedback">Por favor ingresa los apellidos</div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-3">
                <label for="sexo">Sexo*</label>
                <select class="form-control <?= $validation && $validation->hasError('sexo') ? 'is-invalid' : '' ?>" id="sexo" name="sexo" required>
                    <option value="">Seleccionar...</option>
                    <option value="Masculino" <?= old('sexo', $usuario['sexo'] ?? '') === 'Masculino' ? 'selected' : '' ?>>Masculino</option>
                    <option value="Femenino" <?= old('sexo', $usuario['sexo'] ?? '') === 'Femenino' ? 'selected' : '' ?>>Femenino</option>
                    <option value="Otro" <?= old('sexo', $usuario['sexo'] ?? '') === 'Otro' ? 'selected' : '' ?>>Otro</option>
                </select>
                <?php if ($validation && $validation->hasError('sexo')): ?>
                    <div class="invalid-feedback"><?= $validation->getError('sexo') ?></div>
                <?php else: ?>
                    <div class="invalid-feedback">Por favor selecciona el sexo</div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-3">
                <label for="email">Correo electrónico*</label>
                <input type="email" class="form-control <?= $validation && $validation->hasError('email') ? 'is-invalid' : '' ?>" 
                       id="email" name="email" value="<?= old('email', $usuario['email'] ?? '') ?>" required>
                <?php if ($validation && $validation->hasError('email')): ?>
                    <div class="invalid-feedback"><?= $validation->getError('email') ?></div>
                <?php else: ?>
                    <div class="invalid-feedback">Por favor ingresa un correo válido</div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-3">
                <label for="telefono">Teléfono*</label>
                <input type="tel" class="form-control <?= $validation && $validation->hasError('telefono') ? 'is-invalid' : '' ?>" 
                       id="telefono" name="telefono" value="<?= old('telefono', $usuario['telefono'] ?? '') ?>" required>
                <?php if ($validation && $validation->hasError('telefono')): ?>
                    <div class="invalid-feedback"><?= $validation->getError('telefono') ?></div>
                <?php else: ?>
                    <div class="invalid-feedback">Por favor ingresa el teléfono</div>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-md-6">
            <h4>Información General</h4>

            <div class="form-group mb-3">
                <label for="codigo_postal">Código Postal*</label>
                <input type="text" class="form-control <?= $validation && $validation->hasError('codigo_postal') ? 'is-invalid' : '' ?>" 
                       id="codigo_postal" name="codigo_postal" value="<?= old('codigo_postal', $direccion['codigo_postal'] ?? '') ?>" maxlength="5" required>
                <button type="button" class="btn btn-sm btn-outline-secondary mt-2" id="buscar_cp">Buscar CP</button>
                <?php if ($validation && $validation->hasError('codigo_postal')): ?>
                    <div class="invalid-feedback"><?= $validation->getError('codigo_postal') ?></div>
                <?php else: ?>
                    <div class="invalid-feedback">Por favor ingresa un código postal válido</div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-3">
                <label for="colonia">Colonia*</label>
                <select class="form-control <?= $validation && $validation->hasError('colonia') ? 'is-invalid' : '' ?>" id="colonia" name="colonia" required>
                    <option value="">Seleccionar...</option>
                    <?php if (!empty($direccion['colonia'])): ?>
                        <option value="<?= $direccion['colonia'] ?>" selected><?= $direccion['colonia'] ?></option>
                    <?php endif; ?>
                </select>
                <?php if ($validation && $validation->hasError('colonia')): ?>
                    <div class="invalid-feedback"><?= $validation->getError('colonia') ?></div>
                <?php else: ?>
                    <div class="invalid-feedback">Por favor ingresa la colonia</div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-3">
                <label for="municipio">Municipio/Delegación*</label>
                <input type="text" class="form-control <?= $validation && $validation->hasError('municipio') ? 'is-invalid' : '' ?>" 
                       id="municipio" name="municipio" value="<?= old('municipio', $direccion['municipio'] ?? '') ?>" required>
                <?php if ($validation && $validation->hasError('municipio')): ?>
                    <div class="invalid-feedback"><?= $validation->getError('municipio') ?></div>
                <?php else: ?>
                    <div class="invalid-feedback">Por favor ingresa el municipio/delegación</div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-3">
                <label for="estado">Estado*</label>
                <input type="text" class="form-control <?= $validation && $validation->hasError('estado') ? 'is-invalid' : '' ?>" 
                       id="estado" name="estado" value="<?= old('estado', $direccion['estado'] ?? '') ?>" required>
                <?php if ($validation && $validation->hasError('estado')): ?>
                    <div class="invalid-feedback"><?= $validation->getError('estado') ?></div>
                <?php else: ?>
                    <div class="invalid-feedback">Por favor ingresa el estado</div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-3">
                <label for="tipo_usuario">Tipo de Usuario*</label>
                <select class="form-control <?= $validation && $validation->hasError('tipo_usuario') ? 'is-invalid' : '' ?>" id="tipo_usuario" name="tipo_usuario" required>
                    <option value="">Seleccionar...</option>
                    <option value="Administrativo" <?= old('tipo_usuario', $usuario['tipo_usuario'] ?? '') === 'Administrativo' ? 'selected' : '' ?>>Administrativo</option>
                    <option value="Administrativo-Operativo" <?= old('tipo_usuario', $usuario['tipo_usuario'] ?? '') === 'Administrativo-Operativo' ? 'selected' : '' ?>>Administrativo-Operativo</option>
                    <option value="Operativo" <?= old('tipo_usuario', $usuario['tipo_usuario'] ?? '') === 'Operativo' ? 'selected' : '' ?>>Operativo</option>
                </select>
                <?php if ($validation && $validation->hasError('tipo_usuario')): ?>
                    <div class="invalid-feedback"><?= $validation->getError('tipo_usuario') ?></div>
                <?php else: ?>
                    <div class="invalid-feedback">Por favor selecciona un tipo de usuario</div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="<?= base_url('ver-usuario/'.$usuario['id']) ?>" class="btn btn-secondary me-md-2">Cancelar</a>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </div>

    <?= form_close() ?>
</div>
