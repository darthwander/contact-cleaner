@props([
    'icon',
    'label',
    'status',
])
<div class="flex flex-row bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        <button class="flex flex-row items-center">
            <span class="material-symbols-outlined px-2" style="line-height: 1rem; vertical-align: middle;">
                {{ $icon }}
            </span>
        </button>
        <div>
            <span>
                {{ $label }}
            </span>
            <div class="flex justify-center">
                {{ $status ?? 'Desconhecido'}}
            </div>
        </div>
</div>
