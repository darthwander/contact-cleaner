@props([
    'data',
    'head_columns',
    'row_columns',
    'edit_route',
    'delete_route',
    'column_rows',
    'with_actions',
    'modal_name',
    'modal_content'
])

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between mb-4">
                    <div class="flex items-center">
                        <form class="flex" :action="$search_action" method="GET">
                            <input type="text" name="search" placeholder="Pesquise..."
                            class="border border-gray-300 rounded-l px-4 py-2 focus:outline-none focus:border-blue-500 mr-4"
                            value="{{ request('search') }}">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Pesquisar</button>
                        </form>
                    </div>
                    <div class="flex items-center">
                        <button
                            onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: '{{$modal_name}}' }))"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ml-4">
                                Cadastrar
                        </button>
                    </div>
                </div>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-white dark:text-white">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-blue-900 dark:text-gray-400">
                            <tr>
                                @foreach ($head_columns as $column)
                                    <th scope="col" class="px-6 py-3 flex-col items-center text-center text-white">
                                        {{ $column }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row" class="flex px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <x-icon-active :active="$item->active" />
                                        <p class='ml-2'>{{ $item->id }} - {{ data_get($item, $column_rows['column1']) }}</p>
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ data_get($item, $column_rows['column2']) }}
                                    </td>
                                    <td class="flex justify-center px-6 py-4 space-x-9">
                                        @if (in_array('edit', $with_actions))
                                        <div class="relative group">
                                            <a href="{{$edit_route}}/{{$item->id}}" class="text-indigo-600">
                                                <span class="material-symbols-outlined" style="font-size: 20px;">
                                                    edit_document
                                                </span>
                                            </a>
                                            <div class="absolute bottom-full mb-2 px-3 py-2 bg-gray-700 text-white text-sm rounded hidden group-hover:block">
                                                <span>Editar</span>
                                            </div>
                                        </div>
                                        @endif
                                        @if (in_array('users', $with_actions))
                                        <div class="relative group">
                                            <a href="/admin/companies/users/{{$item->id}}" class="text-green-600">
                                                <span class="material-symbols-outlined" style="font-size: 20px;">
                                                    group
                                                </span>
                                            </a>
                                            <div class="absolute bottom-full mb-2 px-3 py-2 bg-gray-700 text-white text-sm rounded hidden group-hover:block">
                                                <span>Usuários</span>
                                            </div>
                                        </div>
                                        @endif
                                        @if (in_array('delete', $with_actions))
                                            <div class="relative group">
                                                <button onclick="confirmDelete({{ $item->id }})" class="text-red-600 hover:underline">
                                                    <span class="material-symbols-outlined" style="font-size: 20px;">
                                                        delete
                                                    </span>
                                                </button>
                                                <form id="delete-form-{{ $item->id }}" action="{{$delete_route}}/{{ $item->id }}" method="POST" class="hidden">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <script>
                                                    function confirmDelete(id) {
                                                        let confirmDelete = confirm('Tem certeza que deseja excluir este item?');
                                                        if (confirmDelete) {
                                                            let form = document.getElementById('delete-form-' + id);
                                                            form.classList.remove('hidden');
                                                            form.submit();
                                                        }
                                                    }
                                                </script>
                                                <div class="absolute bottom-full mb-2 px-3 py-2 bg-gray-700 text-white text-sm rounded hidden group-hover:block">
                                                    <span>Remover</span>
                                                </div>
                                            </div>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $data->links('vendor.pagination.tailwind') }}
                </div>
            </div>
        </div>
    </div>
</div>
<x-modal name="{{ $modal_name }}" maxWidth="2xl" :show="false">
    <x-slot name="content">
        {{ $modal_content }}
    </x-slot>
</x-modal>
