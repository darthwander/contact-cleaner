<div class="card bg-white shadow-xl rounded-lg w-full flex flex-col flex-grow relative">
    <img class="card-img-top rounded-t-lg w-full h-48 object-cover" src="{{ $src }}" alt="{{ $alt }}">
    <div class="card-counter flex items-center justify-end absolute top-0 right-0 w-full h-full">
        <p class="text-white text-right p-2 font-semibold text-8xl">{{{$counter ?? 0000}}}</p>
    </div>
    <div class="card-body flex flex-col p-2 flex-grow">
      <h2 class="card-title text-lg font-medium mb-2">{{ $title ?? 'Título' }}</h2>
      <p class="card-text text-sm text-gray-700">{{ $text }}</p>
    </div>
    <div class="card-footer flex justify-between p-2">
        <a href="{{ $link ?? '#' }}" class="text-blue-500">{{ $linkText ?? 'Mais informações' }}</a>
        <a href="#" class="text-blue-500">{{ $actionText ?? 'Ação' }}</a>
    </div>
</div>
