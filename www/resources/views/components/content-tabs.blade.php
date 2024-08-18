@props([
    'title',
])

    <div class="pt-6 space-y-4">
        <h2 class="text-lg font-medium">{{$title}}</h2>
        {{ $content_tab ?? 'vazio' }}
    </div>

