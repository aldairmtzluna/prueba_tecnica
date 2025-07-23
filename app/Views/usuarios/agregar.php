<div class="container">
    <h2>Agregar Usuario</h2>
    
    <?= form_open('agregar-usuario', ['class' => 'needs-validation', 'novalidate' => '']) ?>
    
    <div class="row">
        <div class="col-md-6">
            <h4>Información Básica</h4>
            
            <div class="form-group mb-3">
                <label for="nombre">Nombre*</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
                <div class="invalid-feedback">Por favor ingresa el nombre</div>
            </div>
            
            <div class="form-group mb-3">
                <label for="apellidos">Apellidos*</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                <div class="invalid-feedback">Por favor ingresa los apellidos</div>
            </div>
            
            <div class="form-group mb-3">
                <label for="sexo">Sexo*</label>
                <select class="form-control" id="sexo" name="sexo" required>
                    <option value="">Seleccionar...</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Otro">Otro</option>
                </select>
                <div class="invalid-feedback">Por favor selecciona el sexo</div>
            </div>
            
            <div class="form-group mb-3">
                <label for="email">Correo electrónico*</label>
                <input type="email" class="form-control" id="email" name="email" required>
                <div class="invalid-feedback">Por favor ingresa un correo válido</div>
            </div>
            
            <div class="form-group mb-3">
                <label for="telefono">Teléfono*</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" required>
                <div class="invalid-feedback">Por favor ingresa el teléfono</div>
            </div>
        </div>
        
        <div class="col-md-6">
            <h4>Información General</h4>
            
            <div class="form-group mb-3">
                <label for="codigo_postal">Código Postal*</label>
                <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" maxlength="5" required>
                <button type="button" class="btn btn-sm btn-outline-secondary mt-2" id="buscar_cp">Buscar CP</button>
                <div class="invalid-feedback">Por favor ingresa un código postal válido</div>
            </div>
            
            <div class="form-group mb-3">
                <label for="colonia">Colonia*</label>
                <select class="form-control" id="colonia" name="colonia" required>
                    <option value="">Seleccionar...</option>
                </select> 
                <div class="invalid-feedback">Por favor ingresa la colonia</div>
            </div>
            
            <div class="form-group mb-3">
                <label for="municipio">Municipio/Delegación*</label>
                <input type="text" class="form-control" id="municipio" name="municipio" required>
                <div class="invalid-feedback">Por favor ingresa el municipio/delegación</div>
            </div>
            
            <div class="form-group mb-3">
                <label for="estado">Estado*</label>
                <input type="text" class="form-control" id="estado" name="estado" required>
                <div class="invalid-feedback">Por favor ingresa el estado</div>
            </div>
            
            <div class="form-group mb-3">
                <label for="tipo_usuario">Tipo de Usuario*</label>
                <select class="form-control" id="tipo_usuario" name="tipo_usuario" required>
                    <option value="">Seleccionar...</option>
                    <option value="Administrativo">Administrativo</option>
                    <option value="Administrativo-Operativo">Administrativo-Operativo</option>
                    <option value="Operativo">Operativo</option>
                </select>
                <div class="invalid-feedback">Por favor selecciona un tipo de usuario</div>
            </div>
        </div>
    </div>
    
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button type="reset" class="btn btn-secondary me-md-2">Limpiar</button>
        <button type="submit" class="btn btn-primary">Guardar Usuario</button>
    </div>
    
    <?= form_close() ?>
</div>