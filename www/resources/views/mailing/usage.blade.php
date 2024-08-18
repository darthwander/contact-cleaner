@php
    $modal_name = "report_usage_modal";
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Relatório de Uso') }}
        </h2>
    </x-slot>
    <x-report-grid
        :data='$uses'
        :head_columns='["Empresa", "Mailings", ""]'
        :column_rows="['column1' => 'company_name', 'column2' => 'counter']"
        :modal_name='$modal_name'
    >
    </x-grid>
</x-app-layout>
