@php
    $modal_name = "create_user_modal";
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __("Usuários da empresa: $company->name ($company->id)") }}
        </h2>
    </x-slot>

    <x-grid
        :data="$users"
        :head_columns="['Nome', 'E-mail', 'Ações']"
        :column_rows="['column1' => 'name', 'column2' => 'email']"
        :search_action="'/admin/companies/users/{{$company->id}}'"
        :edit_route="'/admin/user'"
        :delete_route="'/admin/user'"
        :with_actions="['edit', 'delete']"
        :modal_name=$modal_name
    >
        <x-slot name="modal_content">
            <x-form-create-user :modal_name=$modal_name :company=$company/>
        </x-slot>
    </x-grid>
</x-app-layout>


