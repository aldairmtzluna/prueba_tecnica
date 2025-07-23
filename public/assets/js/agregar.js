document.getElementById('buscar_cp').addEventListener('click', async function() {
    const cp = document.getElementById('codigo_postal').value;
    const cpRegex = /^\d{5}$/;
    
    if (!cpRegex.test(cp)) {
        alert('El código postal debe tener exactamente 5 dígitos numéricos');
        return;
    }

    const btn = this;
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Buscando...';
    
    try {
        const response = await fetch(`${BASE_URL}buscar-cp/${cp}`);
        const data = await response.json();
        
        if (!response.ok || data.error) {
            throw new Error(data.error || 'Error en la respuesta del servidor');
        }
        
        const coloniaSelect = document.getElementById('colonia');
        coloniaSelect.innerHTML = '<option value="">Seleccionar...</option>';
        
        if (data.colonias && data.colonias.length > 0) {
            data.colonias.forEach(colonia => {
                const option = document.createElement('option');
                option.value = colonia;
                option.textContent = colonia;
                coloniaSelect.appendChild(option);
            });
            
            document.getElementById('municipio').value = data.municipio || '';
            document.getElementById('estado').value = data.estado || '';
        } else {
            alert('No se encontraron colonias para este código postal');
        }
        
    } catch (error) {
        console.error('Error:', error);
        alert('Error al consultar: ' + error.message);
    } finally {
        btn.disabled = false;
        btn.innerHTML = 'Buscar CP';
    }
});