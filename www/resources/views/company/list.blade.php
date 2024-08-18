@php
    $modal_name = "create_company_modal";
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Empresas') }}
        </h2>
    </x-slot>

    <x-grid
        :data="$companies"
        :head_columns="['Nome', 'CNPJ', 'Ações']"
        :column_rows="['column1' => 'name', 'column2' => 'cnpj']"
        :search_action="route('admin.company.list')"
        :edit_route="'/admin/companies'"
        :delete_route="'/admin/companies'"
        :with_actions="['edit', 'delete', 'users']"
        :modal_name=$modal_name
    >
        <x-slot name="modal_content">
            <x-form-create-company :modal_name=$modal_name/>
        </x-slot>
    </x-grid>
</x-app-layout>

