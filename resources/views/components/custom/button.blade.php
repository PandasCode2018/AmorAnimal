@props(['icon' => ''])
<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']) }}>
    @if ($icon)
        <i class="{{ $icon }} mr-2"></i>
    @endif
    {{ $slot }}
</button>
