<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Variables globales
    let currentEditId = null;
    let currentEditType = null;

    // Configurar eventos comunes
    document.addEventListener('DOMContentLoaded', function() {
        // Eventos para editar y eliminar
        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.addEventListener('click', function() {
                const type = this.getAttribute('data-type');
                const id = this.getAttribute('data-id');
                openEditModal(type, id);
            });
        });

        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', function() {
                const type = this.getAttribute('data-type');
                const id = this.getAttribute('data-id');
                
                if (confirm('¿Está seguro que desea eliminar este registro?')) {
                    deleteRecord(type, id);
                }
            });
        });
    });

    // Funciones comunes
    function openEditModal(type, id) {
        currentEditId = id;
        currentEditType = type;
        
        fetch(`/api/${type}s/${id}/edit`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('modal-title').textContent = `Editar ${type.charAt(0).toUpperCase() + type.slice(1)}`;
                
                // Configurar el contenido del modal según el tipo
                let modalContent = '';
                
                if (type === 'gasto') {
                    modalContent = `
                        <div class="mb-3">
                            <label for="edit-fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="edit-fecha" value="${data.fecha}">
                        </div>
                        <!-- Más campos del formulario -->
                    `;
                }
                
                document.getElementById('modal-body').innerHTML = modalContent;
                
                // Mostrar modal
                const modal = new bootstrap.Modal(document.getElementById('edit-modal'));
                modal.show();
            });
    }

    function deleteRecord(type, id) {
        fetch(`/api/${type}s/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            }
        });
    }

    // Configurar evento para guardar cambios en el modal
    document.getElementById('modal-save').addEventListener('click', function() {
        if (!currentEditId || !currentEditType) return;
        
        const formData = {};
        // Recopilar datos del formulario de edición
        
        fetch(`/api/${currentEditType}s/${currentEditId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const modal = bootstrap.Modal.getInstance(document.getElementById('edit-modal'));
                modal.hide();
                window.location.reload();
            }
        });
    });
</script>