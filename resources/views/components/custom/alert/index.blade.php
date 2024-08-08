@props(['as' => 'div', 'variant' => null, 'dismissible' => null])

@php
    // Define color schemes for different alert types
    $primary = [
        'bg-primary border-primary text-white',
        'dark:border-primary',
    ];
    $secondary = [
        'bg-secondary/70 border-secondary/70 text-slate-500',
        'dark:border-darkmode-400 dark:bg-darkmode-400 dark:text-slate-300',
    ];
    $success = [
        'bg-success border-success text-slate-900',
        'dark:border-success',
    ];
    $warning = [
        'bg-warning border-warning text-slate-900',
        'dark:border-warning',
    ];
    $pending = [
        'bg-pending border-pending text-white',
        'dark:border-pending',
    ];
    $danger = [
        'bg-danger border-danger text-white',
        'dark:border-danger',
    ];
    $dark = [
        'bg-dark border-dark text-white',
        'dark:bg-darkmode-800 dark:border-transparent dark:text-slate-300',
    ];

    // Define outline styles for different alert types
    $outlinePrimary = [
        'border-primary text-primary',
        'dark:border-primary',
    ];
    $outlineSecondary = [
        'border-secondary text-slate-500',
        'dark:border-darkmode-100/40 dark:text-slate-300',
    ];
    $outlineSuccess = [
        'border-success text-success dark:border-success',
        'dark:border-success',
    ];
    $outlineWarning = [
        'border-warning text-warning',
        'dark:border-warning',
    ];
    $outlinePending = [
        'border-pending text-pending',
        'dark:border-pending',
    ];
    $outlineDanger = [
        'border-danger text-danger',
        'dark:border-danger',
    ];
    $outlineDark = [
        'border-dark text-dark',
        'dark:border-darkmode-800 dark:text-slate-300',
    ];

    // Define soft color styles for different alert types
    $softPrimary = [
        'bg-primary border-primary bg-opacity-20 border-opacity-5 text-primary',
        'dark:border-opacity-100 dark:bg-opacity-20 dark:border-primary',
    ];
    $softSecondary = [
        'bg-slate-300 border-secondary bg-opacity-10 text-slate-500',
        'dark:bg-darkmode-100/20 dark:border-darkmode-100/30 dark:text-slate-300',
    ];
    $softSuccess = [
        'bg-success border-success bg-opacity-20 border-opacity-5 text-success',
        'dark:border-success dark:border-opacity-20',
    ];
    $softWarning = [
        'bg-warning border-warning bg-opacity-20 border-opacity-5 text-warning',
        'dark:border-warning dark:border-opacity-20',
    ];
    $softPending = [
        'bg-pending border-pending bg-opacity-20 border-opacity-5 text-pending',
        'dark:border-pending dark:border-opacity-20',
    ];
    $softDanger = [
        'bg-danger border-danger bg-opacity-20 border-opacity-5 text-danger',
        'dark:border-danger dark:border-opacity-20',
    ];
    $softDark = [
        'bg-dark border-dark bg-opacity-20 border-opacity-5 text-dark',
        'dark:bg-darkmode-800/30 dark:border-darkmode-800/60 dark:text-slate-300',
    ];
@endphp

<{{ $as }}
    role="alert"
    {{ $attributes->class(
        merge([
            'alert relative border rounded-md px-5 py-4',
            $variant == 'primary' ? $primary : null,
            $variant == 'secondary' ? $secondary : null,
            $variant == 'success' ? $success : null,
            $variant == 'warning' ? $warning : null,
            $variant == 'pending' ? $pending : null,
            $variant == 'danger' ? $danger : null,
            $variant == 'dark' ? $dark : null,
            $variant == 'outline-primary' ? $outlinePrimary : null,
            $variant == 'outline-secondary' ? $outlineSecondary : null,
            $variant == 'outline-success' ? $outlineSuccess : null,
            $variant == 'outline-warning' ? $outlineWarning : null,
            $variant == 'outline-pending' ? $outlinePending : null,
            $variant == 'outline-danger' ? $outlineDanger : null,
            $variant == 'outline-dark' ? $outlineDark : null,
            $variant == 'soft-primary' ? $softPrimary : null,
            $variant == 'soft-secondary' ? $softSecondary : null,
            $variant == 'soft-success' ? $softSuccess : null,
            $variant == 'soft-warning' ? $softWarning : null,
            $variant == 'soft-pending' ? $softPending : null,
            $variant == 'soft-danger' ? $softDanger : null,
            $variant == 'soft-dark' ? $softDark : null,
            $dismissible ? 'pl-5 pr-16' : null,
        ]),
    )->merge($attributes->whereDoesntStartWith('class')->getAttributes()) }}
>
    {{ $slot }}
    @if ($dismissible)
        <button type="button" class="absolute top-2 right-2 text-white hover:text-gray-300" aria-label="Close">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    @endif
</{{ $as }}>
