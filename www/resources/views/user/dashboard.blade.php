<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- Elemento de Conteúdo Atualizado por SSE --}}
    {{-- <div class="py-12">
        <div id="sse-content">
            <!-- Atualizando o conteúdo atualizado por SSE -->
        </div>
    </div> --}}

    {{-- Exemplo de Eventos Usando SSE
    <script>
        const eventSource = new EventSource("/sse");

        eventSource.onmessage = function(event) {
            console.log("New event:", event.data);

            // Atualizando o conteúdo do DOM
            const data = JSON.parse(event.data);
            const contentElement = document.getElementById('sse-content');
            contentElement.innerHTML = `Server Time: ${data.time}`;
        };

        eventSource.onerror = function(error) {
            console.error("EventSource failed:", error);
            eventSource.close();
        };
    </script> --}}
</x-app-layout>

