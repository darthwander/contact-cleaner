@props([
    'email' => 'email@example.com',
    'entity' => 'Admin Example',
    'image' => 'https://picsum.photos/200/300',
    'active',
    'color' => 'white',
    ])

<div class="w-full max-w-sm bg-white border border-{{$color}}-200 rounded-lg shadow dark:bg-{{$color}}-900 dark:border-{{$color}}-700">
    <div class="flex justify-end px-4 pt-4">
        @if ($active)
            <span class="material-symbols-outlined" style="color: rgb(0, 255, 0); font-size: 50px">
                toggle_on
            </span>
        @else
            <span class="material-symbols-outlined" style="color: red; font-size: 50px">
                toggle_off
            </span>
        @endif
    </div>
    <div class="flex flex-col items-center pb-10">
        <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ $image }}" alt="{{$entity}}"/>
        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $entity }}</h5>
        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $email}}</span>
        <div class="flex mt-4 md:mt-6">
            <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Editar
            </a>
            <a href="#" class="py-2 px-4 ms-2 text-sm font-medium text-red-900 focus:outline-none bg-white rounded-lg border border-red-200 hover:bg-red-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-red-100 dark:focus:ring-red-700 dark:bg-red-800 dark:text-red-400 dark:border-red-600 dark:hover:text-white dark:hover:bg-red-700">
                Excluir
            </a>
        </div>
    </div>
</div>
