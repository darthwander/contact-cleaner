@props([
    'data',
    'head_columns',
    'row_columns',
    'column_rows',
])



<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
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
                </div>
                <div class="py-2 px-4 relative overflow-x-auto shadow-md rounded-t-lg w-full bg-gray-50 dark:bg-blue-900">
                    <h2 class="text-sm text-gray-100 uppercase rtl:text-right text-left">
                        Empresa <span class="text-xs">(Quantidade)</span>
                    </h2>
                    <hr class="border-t border-gray-200 dark:border-gray-700">
                </div>

                <div class="relative overflow-x-auto shadow-md">
                    @php $color = false; @endphp
                    @foreach ($data as $item)
                        <tr>
                            <x-collapse
                                :title="data_get($item, $column_rows['column1']) .' ('.data_get($item, $column_rows['column2']).')' "
                                :creation_date="$item->creation_date"
                                :color=$color
                            >
                                <x-slot name="collapse_content">
                                    @foreach (json_decode($item->mailings) as $mailing)
                                    <div class="p-4 bg-white">
                                        <x-collapse-content
                                        :description="$mailing->description"
                                        :download_url="$mailing->filename"
                                        :creation_date="$item->creation_date"
                                        :status_load="$mailing->status_load"
                                        :status_wipe="$mailing->status_wipe"
                                        :error="$mailing->error"
                                        :setup="$mailing->setup"
                                    />
                                    </div>
                                    @endforeach
                                </x-slot>
                            </x-collapse>
                            @php $color = !$color; @endphp
                        </tr>
                    @endforeach
                </div>

                <div class="mt-4">
                    {{ $data->links('vendor.pagination.tailwind') }}
                </div>

            </div>
        </div>
    </div>

</div>
