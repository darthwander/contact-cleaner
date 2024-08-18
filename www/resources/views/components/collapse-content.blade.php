@props([
    'description',
    'download_url',
    'creation_date',
    'status_load',
    'status_wipe',
    'error',
    'setup',
])
<div class="flex-col justify-end items-end">
    <div class="rounded-t-lg p-2 float-right bg-transparent">
        <a href="{{ $download_url }}">
            <span class="material-symbols-outlined float-right px-2">
                download
            </span>
            Download
        </a>
    </div>
    <div class="p-2 bg-white dark:bg-gray-100 space-y-2 border-gray-800">
        <div>
            <div>
                <p class="text-lg font-semibold text-gray-800 text-black">
                    {{ $description }}
                </p>
            </div>
        </div>

        <div class="grid grid-cols-4 gap-2">
            <x-default-button  :status=$status_load icon="rotate_right" label="Carregamento" />
            <x-default-button  :status=$status_wipe icon="mop" label="Limpeza" />
            <x-default-button  :status=$error icon="report" label="Erro" />
            <x-default-button  :status=$setup icon="manufacturing" label="Setup" />
        </div>
    </div>
</div>

