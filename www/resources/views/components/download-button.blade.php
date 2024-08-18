@props([
    'download_url',
])
<div class="float-right bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
    <a href="{{ $download_url }}" download>
        <button class="flex flex-row">
            <span class="material-symbols-outlined float-right px-2">
                download
            </span>
            <span>
                Download
            </span>
        </button>
    </a>
</div>
