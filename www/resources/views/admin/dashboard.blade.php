<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4 py-4 justify-items-center place-items-center">
        <x-banner
            class="col-span-1"
            src="/img/companies.jpg"
            alt="Lorem ipsum"
            title="Empresas Cadastradas"
            text="Total de clientes cadastrados no sistema."
            :counter="$companies" />
        <x-banner
            class="col-span-1"
            src="/img/mailings.jpg"
            alt="Lorem ipsum"
            title="Total de Mailings"
            text="Quantidade de mailings gerados nos ultimos 28 dias"
            :counter="$mailings" />
    </div>
</x-app-layout>

