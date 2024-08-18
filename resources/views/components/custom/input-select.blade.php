@props([
    'id' => '',
    'classLabel' => '',
    'label' => '',
    'value' => false,
    'name' => false,
    'title' => false,
    'titleInput' => false,
    'required' => false,
    'classInput' => '',
])
<div>
    <x-custom.form-label for="{{ $id }}" title="{{ $title }}"
        class="form-label text-left w-full {{ $title ? 'tooltip' : '' }} {{ $classLabel }}">{{ $label }}
        {{ $required ? '*' : '' }}
    </x-custom.form-label>

    <select id="{{ $id }}" @if ($required) required @endif
        @if ($name) name="{{ $name }}" @endif
        @if ($value) value="{{ $value }}" @endif
        @if ($titleInput) title="{{ $titleInput }}" @endif
        {{ $attributes->merge([
            'class' => "transition duration-200 ease-in-out w-full text-sm  border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-2 focus:ring-primary 
                        focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800  dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80
                        disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent readonly:bg-slate-100 
                        readonly:cursor-not-allowed readonly:dark:bg-darkmode-800/50 readonly:dark:border-transparent group-[.form-inline]:flex-1 group-[.input-group]:rounded-none 
                        group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 $classInput",
        ]) }}>
        {{ $slot }}
    </select>
</div>
