@props(['icon' => ''])
<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none']) }}>
    {{ $slot }}
    @if ($icon)
        <i class="{{ $icon }} text-lg"></i>
    @endif
</button>
