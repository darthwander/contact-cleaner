@props([
    'company'
])
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edição de Cadastro de Empresa') }}
        </h2>
    </x-slot>

    <div class="isolate px-6 py-12">
        <x-form-edit-company :company="$company" />
    </div>

</x-app-layout>
