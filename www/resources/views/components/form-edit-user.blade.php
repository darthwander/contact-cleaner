@props(['user'])
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <form action="{{route('admin.user.edit', $user->id)}}" method="POST" id="user-form">
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
                        <div class="mt-10 flex flex-col gap-y-10 sm:grid-cols-8">
                            <div class="sm:col-span-3">
                                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nome</label>
                                <div class="mt-2">
                                    <input
                                        value="{{ $user->name }}"
                                        type="text"
                                        name="name"
                                        id="name"
                                        autocomplete="given-name"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            <div class="sm:col-span-3">
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">E-mail</label>
                                <div class="mt-2">
                                    <input
                                        value="{{ $user->email }}"
                                        type="text"
                                        name="email"
                                        id="email"
                                        autocomplete="given-name"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            <div class="sm:col-span-2">
                                <div class="mt-2">
                                    <x-checkbox label="Ativo" checked="{{ $user->active }}" id='active' name="active"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="button" class="text-sm font-semibold leading-6 text-gray-900" onclick="window.location.href = '{{ route('admin.company.users', $user->company_id) }}'">
                        Cancel
                    </button>
                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

