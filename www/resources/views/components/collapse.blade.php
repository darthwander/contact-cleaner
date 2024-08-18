
@props([
    'title' => 'Titulo',
    'color' => true,
    'creation_date',
])

@php
    $color = $color ? '400' : '700';
@endphp
<div x-data="{ open: false }" class="w-full">
    <button @click="open = !open" class="grid grid-cols-10 gap-2 w-full bg-gray-{{$color}} text-white font-bold py-2 px-4  focus:outline-none focus:shadow-outline">

        <div class="col-span-7 flex justify-between items-center">
            <span>{{ $title }}</span>
        </div>

        <div class="col-span-2">
            <span class="float-right">{{ $creation_date }}</span>
        </div>

        <div class="col-span-1 flex justify-end">
            <svg :class="{'hidden': !open}" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 9.293a1 1 0 011.414 0L10 12.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
            <svg :class="{'hidden': open}" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M14.707 10.707a1 1 0 01-1.414 0L10 7.414 6.707 10.707a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
        </div>
    </button>

    <div x-show="open" x-transition class="mt-2 p-4 border border-gray-{{$color}}">
       {{ $collapse_content }}
    </div>
</div>

