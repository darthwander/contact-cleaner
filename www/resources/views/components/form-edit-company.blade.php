@props(['company'])
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <form action="{{route('admin.company.edit', $company->id)}}" method="POST" id="company-form">
                @csrf
                <div class="space-y-12">
                    <div>
                        <h2 class="text-3xl font-bold leading-9 text-gray-900 sm:leading-10">Edição de Cadastro</h2>
                        <hr>
                        @if ($errors->any())
                            <div class="mt-4">
                                @foreach ($errors->all() as $error)
                                    <script>
                                        toastr.error('{{ $error }}');
                                    </script>
                                @endforeach
                            </div>
                        @endif
                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Razão Social</label>
                                <div class="mt-2">
                                    <input
                                        value="{{ $company->name }}"
                                        type="text"
                                        name="name"
                                        id="name"
                                        autocomplete="given-name"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            <div class="sm:col-span-3">
                                <label for="cnpj" class="block text-sm font-medium leading-6 text-gray-900">CNPJ</label>
                                <div class="mt-2">
                                    <input
                                        value="{{ $company->cnpj }}"
                                        type="text"
                                        name="cnpj"
                                        id="cnpj"
                                        autocomplete="given-name"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            <div class="sm:col-span-3">
                                <label for="webhook_url" class="block text-sm font-medium leading-6 text-gray-900">Webhook</label>
                                <div class="mt-2">
                                    <input
                                        value="{{ $company->webhook_url }}"
                                        type="text"
                                        name="webhook_url"
                                        id="webhook_url"
                                        autocomplete="given-name"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            <div class="sm:col-span-3">
                                <label for="api_token" class="block text-sm font-medium leading-6 text-gray-900">API Token</label>
                                <div class="mt-2">
                                    <input
                                        value="{{ $company->api_token }}"
                                        type="text"
                                        name="api_token"
                                        id="api_token"
                                        autocomplete="given-name"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-2xl font-semibold leading-7 text-gray-900">Configurações</h2>
                        <hr>
                        <div class="mt-6 grid grid-cols-2 gap-x-6">
                            <div class="space-y-6">
                                <x-checkbox checked="{{ $company->active }}" label="Empresa Ativa" id='active' name="active"/>
                                <x-checkbox checked="{{ $company->only_200 }}" label="Filtrar Apenas 200" id='only_200' name="only_200"/>
                                <x-checkbox checked="{{ $company->only_200_wp }}" label="Apenas 200 com segundos" id='only_200_wp' name="only_200_wp"/>

                            </div>
                            <div class="space-y-6">
                                <x-checkbox checked="{{ $company->delete_only_404 }}" label="Deletar Apenas 404" id='delete_only_404' name="delete_only_404"/>
                                <x-checkbox checked="{{ $company->code_487 }}" label="Obter 487" id='code_487' name="code_487"/>
                                <x-checkbox checked="{{ $company->code_487_wp }}" label="Obter 487 com tentativas" id='code_487_wp' name="code_487_wp"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="button" class="text-sm font-semibold leading-6 text-gray-900" onclick="window.location.href = '{{ route('admin.company.list') }}'">
                        Cancel
                    </button>
                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

