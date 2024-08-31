
import TomSelect from 'tom-select';

document.addEventListener('DOMContentLoaded', function () {
    document.addEventListener('livewire:load', function () {

        alert('hhh');
        new TomSelect(".tom-select", {
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });
    });

});


