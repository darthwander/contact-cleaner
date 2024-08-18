<div>
    <x-grid-cards
        :data="$data"
        color="gray"
        :head_columns="['Nome', 'CNPJ', 'Ações']"
        :column_rows="['column1' => 'name', 'column2' => 'cnpj']"
        :search_action="route('admin.company.list')"
        :edit_route="'/admin/companies'"
        :delete_route="'/admin/companies'"
        :modal_name="'create_admin_modal'"
        >
        <x-slot name="modal_content">

        </x-slot>
    </x-grid-cards>
</div>
