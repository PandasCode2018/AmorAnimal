import Shepherd from 'shepherd.js';
import 'shepherd.js/dist/css/shepherd.css';

Livewire.on('tutorial', (event) => {

    const tour = new Shepherd.Tour({
        useModalOverlay: true,
        defaultStepOptions: {
            cancelIcon: {
                enabled: true,
            },
            classes: 'shepherd-theme-dark',
            scrollTo: { behavior: "smooth", block: "center" },
            showCancelLink: true, // Muestra el enlace de cancelación
            showCloseButton: true, // Muestra el botón de cerrar
            keyboardNavigation: true // Permite la navegación con teclado
        }
    });

    const steps = event;
    steps.forEach((stepArray, index) => {
        stepArray.forEach((step) => {
            tour.addStep({
                id: `step-${index}`,
                title: step.title,
                text: step.text,
                attachTo: {
                    element: `.${step.element}`,
                    on: 'bottom'
                },
                classes: 'custom-step',
                buttons: [
                    {
                        text: 'Atras',
                        action: tour.back,
                        classes: 'shepherd-button-secondary'
                    },
                    {
                        text: 'Siguiente',
                        action: tour.next,
                        classes: 'shepherd-button-primary'
                    }
                ]
            });
        });

    });
    tour.start();

});


