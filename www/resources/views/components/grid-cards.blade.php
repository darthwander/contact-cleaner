@props([
    'data',
    'color',
    'edit_route',
    'delete_route',
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

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($data as $item)
                        <div class="flex flex-col gap-4">
                            <x-admin-card
                                :admin="$item->name"
                                :email="$item->email"
                                id="{{$item->id}}"
                                active="{{$item->active}}"
                                :color="$color"
                            />
                        </div>
                    @endforeach
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
