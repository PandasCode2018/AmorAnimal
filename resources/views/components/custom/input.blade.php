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
    'class' => false,
    'classLabel' => false,
    'errorMessage' => false,
])
{{-- @if ($label)
    <x-base.form-label for="{{ $id }}" title="{{ $title }}"
        class="form-label text-left w-full {{ $title ? 'tooltip' : '' }} {{ $classLabel ? $classLabel : '' }}">{{ $label }}
        {{ $required ? '*' : '' }}</x-base.form-label>
@endif --}}

<input id="{{ $id }}" @if ($required) required @endif
    @if ($titleInput) title="{{ $titleInput }}" @endif
    @if ($value) value="{{ $value }}" @endif
    @if ($accept) accept="{{ $accept }}" @endif
    @if ($name) name="{{ $name }}" @endif
    @if ($readonly) readonly @endif @if ($disabled) disabled @endif
    @if ($attributes->get('wire:model.live')) wire:model.live="{{ $attributes->wire('model')->value() }}"
        @elseif($attributes->get('wire:model.blur'))
            wire:model.blur="{{ $attributes->wire('model')->value() }}"
        @elseif($attributes->get('wire:model'))
            wire:model="{{ $attributes->wire('model')->value() }}" @endif
    type="{{ $type }}" {{-- class="{{ $titleInput ? 'tooltip' : '' }} @error(strlen($attributes?->wire('model')?->value()) > 0 ? $attributes?->wire('model')?->value() : $id) border-danger @enderror {{ $class ? $class : '' }}" data-tw-merge --}}
    {{ $attributes->class(
            merge([
                $titleInput ? 'tooltip' : '',
                'disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent',
                '[&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent',
                'transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80',
                'group-[.form-inline]:flex-1',
                'group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10',
                $attributes->whereStartsWith('class')->first(),
            ]),
        )->merge($attributes->whereDoesntStartWith('class')->getAttributes()) }}
    placeholder="{{ $placeholder }}" maxlength="{{ $maxLength }}"
    @if ($minLength > 0) minlength="{{ $minLength }}" @endif />

@if ($errorMessage)
    <x-custom.error
        property="{{ strlen($attributes?->wire('model')?->value()) > 0 ? $attributes?->wire('model')?->value() : $id }}" />
@endif

