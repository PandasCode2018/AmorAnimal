
function closeModal(elements) {
    if (!elements) {
        return;
    }
    elements.forEach((el) => {
        const modal = tailwind.Modal.getOrCreateInstance(el);
        modal.hide();
    });
}

window.document.addEventListener('livewire:init', () => {

    Livewire.on('openModal', ({ modalId }) => {
        const el = document.querySelector("#" + modalId);
        if (!el) {
            return;
        }
        const modal = tailwind.Modal.getOrCreateInstance(el);
        modal.show();
    });

    Livewire.on('closeModal', ({ modalId }) => {
        const elements = document.querySelectorAll("#" + modalId);
        closeModal(elements);
    });

    Livewire.on('toggleModal', ({ modalId }) => {
        closeModal(document.querySelectorAll("#" + modalId));
        const el = document.querySelector("#" + modalId);
        if (!el) {
            return;
        }
        const modal = tailwind.Modal.getOrCreateInstance(el);
        modal.toggle();
    });


    Livewire.on('closeAllModals', () => {
        const modals = document.querySelectorAll('.modal');
        modals.forEach((el) => {
            const modal = tailwind.Modal.getOrCreateInstance(el);
            if (modal) {
                modal.hide();
            }
        });
    });
    
});
