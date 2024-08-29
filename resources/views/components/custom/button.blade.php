@props(['icon' => ''])
<button
    {{ $attributes->merge(['type' => 'submit', 'class' => ' text-white font-bold py-2 px-4 rounded focus:outline-none']) }}>
    {{ $slot }}
    @if ($icon)
        <i class="{{ $icon }} text-lg"></i>
    @endif
</button>
