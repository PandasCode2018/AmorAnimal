@props(['message' => 'Creando Registo...', 'tarejt'])

<div wire:loading wire:target='{{ $tarejt }}'
    class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 flex items-center space-x-3">
        <svg class="w-6 h-6 text-blue-500 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 6v6l4 2m0-12a9 9 0 00-9 9 9 9 0 009 9v-2a7 7 0 01-7-7 7 7 0 017-7z" />
        </svg>
        <p class="text-gray-700">{{ $message }}</p>
    </div>
</div>
