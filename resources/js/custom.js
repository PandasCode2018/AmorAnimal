/* document.addEventListener('DOMContentLoaded', () => {
    Livewire.on('openModal', modalId => {
        // Emitir el evento para abrir el modal en Livewire
        Livewire.emit('openModal', modalId);
    });

    window.addEventListener('closeModal', () => {
        // Cerrar el modal
        document.querySelectorAll('[x-data]').forEach(el => {
            el.__x.$data.showModal = false;
        });
    });
}); */