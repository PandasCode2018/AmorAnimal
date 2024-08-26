

document.addEventListener('livewire:load', function () {
    console.log('Livewire cargado');
    Livewire.hook('message.processed', (message, component) => {
        console.log('Mensaje procesado');
        $('.select2').select2({
            minimumResultsForSearch: '',
        });
    });
});


