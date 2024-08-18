@props([
    'company',
    'modal_name'
    ])

<form action="{{ route('admin.user.store') }}" method="POST" id="user-form">
    @csrf
    <div class="space-y-12">
        <div>
            <h2 class="text-3xl font-bold leading-9 text-gray-900 sm:leading-10">Novo Usuário</h2>
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
                <input type="hidden" name="company_id" id="company_id" value="{{ $company->id }}">
                <div class="sm:col-span-3">
                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Empresa</label>
                    <div class="mt-2">
                        <input
                            value="{{ $company->name }}"
                            disabled
                            type="text"
                            name="company"
                            id="company"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="sm:col-span-3">
                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nome</label>
                    <div class="mt-2">
                        <input
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
                            type="text"
                            name="email"
                            id="email"
                            autocomplete="given-name"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="sm:col-span-3">
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Senha</label>
                    <div class="mt-2">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        autocomplete="new-password"
                        >
                    </div>
                </div>
                <div class="sm:col-span-3">
                    <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Confirmação de Senha</label>
                    <div class="mt-2">
                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        autocomplete="new-password"
                        >
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <div class="mt-2">
                        <x-checkbox label="Ativo" id='active' name="active"/>
                    </div>
                </div>
            </div>
        </div>
    <div class="mt-6 flex items-center justify-end gap-x-6">
        <button type="button" class="text-sm font-semibold leading-6 text-gray-900" onclick="window.dispatchEvent(new CustomEvent('close-modal', { detail: 'create_user_modal' }))">
            Cancel
        </button>
        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
    </div>
</form>
<script>
 document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('user-form');

    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault(); // Impede o comportamento padrão de submissão

            let formData = new FormData(form);

            fetch(form.action, {
                method: form.method,
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    return response.json().then(errors => {
                        throw errors;
                    });
                }
            }).then(data => {
                if (data.msg) {
                    // Armazena a mensagem de sucesso no localStorage
                    localStorage.setItem('successMessage', data.msg);

                    // Recarrega a página imediatamente
                    window.location.reload();
                } else {
                    toastr.error('Erro inesperado. Por favor, tente novamente mais tarde.');
                }

            }).catch(errors => {
                // Limpa mensagens de erro anteriores
                document.querySelectorAll('.error-message').forEach(el => el.remove());

                if (errors && errors.errors) {
                    for (let [field, messages] of Object.entries(errors.errors)) {
                        let input = document.querySelector(`[name="${field}"]`);
                        if (input) {
                            messages.forEach(message => {
                                let errorMessage = document.createElement('div');
                                errorMessage.classList.add('error-message', 'text-red-600', 'text-sm');
                                errorMessage.innerText = message;
                                input.parentElement.appendChild(errorMessage);
                            });
                        }
                    }
                    toastr.error('Erro ao salvar o usuário. Verifique os campos e tente novamente.');
                } else {
                    toastr.error('Erro inesperado. Por favor, tente novamente mais tarde.');
                }
            }).catch(() => {
                toastr.error('Erro de rede. Por favor, tente novamente mais tarde.');
            });
        });
    }

    // Verifica se há uma mensagem de sucesso no localStorage após o recarregamento
    const successMessage = localStorage.getItem('successMessage');
    if (successMessage) {
        toastr.success(successMessage);
        localStorage.removeItem('successMessage'); // Remove a mensagem após exibi-la
    }
});
</script>
