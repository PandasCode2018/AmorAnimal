@props([
    'label' => false,
    'id',
    'type' => 'text',
    'accept' => '',
    'placeholder' => '',
    'required' => false,
    'maxLength' => 255,
    'minLength' => false,
    'title' => false,
    'titleInput' => false,
    'disabled' => false,
    'readonly' => false,
    'name' => false,
    'value' => false,
    'class' => '',
    'classLabel' => '',
    'errorMessage' => false,
])

@if ($label)
    <x-custom.form-label for="{{ $id }}" title="{{ $title }}"
        class="form-label text-left w-full {{ $title ? 'tooltip' : '' }} {{ $classLabel }}">{{ $label }}
        {{ $required ? '*' : '' }}</x-custom.form-label>
@endif

<input id="{{ $id }}" @if ($required) required @endif
    @if ($titleInput) title="{{ $titleInput }}" @endif
    @if ($value) value="{{ $value }}" @endif
    @if ($accept) accept="{{ $accept }}" @endif
    @if ($name) name="{{ $name }}" @endif
    @if ($readonly) readonly @endif @if ($disabled) disabled @endif
    @if ($attributes->get('wire:model.live')) wire:model.live="{{ $attributes->wire('model')->value() }}"
        @elseif($attributes->get('wire:model.live.blur'))
            wire:model.live.blur="{{ $attributes->wire('model')->value() }}"
        @elseif($attributes->get('wire:model.live'))
            wire:model.live="{{ $attributes->wire('model')->value() }}" @endif
    type="{{ $type }}"
    {{ $attributes->merge([
        'class' => "transition duration-200 ease-in-out w-full text-sm  border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 bg-[#f3faf8] focus:ring-2 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800  dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent readonly:bg-slate-100 readonly:cursor-not-allowed readonly:dark:bg-darkmode-800/50 readonly:dark:border-transparent group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 $class",
    ]) }}
    placeholder="{{ $placeholder }}" maxlength="{{ $maxLength }}"
    @if ($minLength > 0) minlength="{{ $minLength }}" @endif />

@if ($errorMessage)
    <x-custom.error
        property="{{ strlen($attributes?->wire('model')?->value()) > 0 ? $attributes?->wire('model')?->value() : $id }}" />
@endif
