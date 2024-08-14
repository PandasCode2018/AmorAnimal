window.document.addEventListener('livewire:init', () => {

});
Livewire.on('notification', (event) => {
    const { type, message, title, timer } = event[0];
    switch (type) {
        case 'error':
            var icon = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-danger w-6 h-6">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line>
            </svg>`
            break;
        case 'warning':
            var icon = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="text-warning  w-6 h-6">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="16" x2="12" y2="12"></line>
                <line x1="12" y1="8" x2="12.01" y2="8"></line>
            </svg>`
            break;
        default:
            var icon = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round" data-lucide="check-circle"
            class="lucide lucide-check-circle text-primary w-6 h-6">
            <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
        </svg>`;

            break;
    }
    //    escribir en un div del html el html que se quiere mostrar
    const html = `<div id="success-notification-content" class="py-5 pl-5 pr-14 bg-white border border-slate-200/60 rounded-lg shadow-xl dark:bg-darkmode-600 dark:text-slate-300 dark:border-darkmode-600 flex">
            ${icon}
            <div class="ml-4 mr-4">
                <div class="font-medium">${title ? title : 'Acción Exitosa'}</div>
                <div class="mt-1 text-slate-500">
                    ${message ? message : 'La acción se ha realizado correctamente'}
                </div>
            </div>
        </div>`;

    //    crear un div y agregarle el html
    const div = document.createElement('div');
    div.innerHTML = html;
    //    crear el toastify
    Toastify({
        node: $(div).find('#success-notification-content').clone()[0],
        duration: timer ? timer : 5000,
        newWindow: true,
        close: true,
        gravity: "top",
        position: "right",
        stopOnFocus: true,
    }).showToast();
});
