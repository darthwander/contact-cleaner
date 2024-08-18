@props([
    'modal_name'
])
<form action="{{ route('admin.company.store') }}" method="POST" id="company-form">
    @csrf
    <div class="space-y-12">
        <div>
            <h2 class="text-3xl font-bold leading-9 text-gray-900 sm:leading-10">Nova Empresa</h2>
            <hr>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Razão Social</label>
                    <div class="mt-2">
                        <input type="text" name="name" id="name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="sm:col-span-3">
                    <label for="cnpj" class="block text-sm font-medium leading-6 text-gray-900">CNPJ</label>
                    <div class="mt-2">
                        <input type="text" name="cnpj" id="cnpj" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="sm:col-span-3">
                    <label for="webhook_url" class="block text-sm font-medium leading-6 text-gray-900">Webhook</label>
                    <div class="mt-2">
                        <input type="text" name="webhook_url" id="webhook_url" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="sm:col-span-3">
                    <label for="api_token" class="block text-sm font-medium leading-6 text-gray-900">API Token</label>
                    <div class="mt-2">
                        <input type="text" name="api_token" id="api_token" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
            </div>
        </div>

        <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-2xl font-semibold leading-7 text-gray-900">Configurações</h2>
            <hr>
            <div class="mt-6 grid grid-cols-2 gap-x-6">
                <div class="space-y-6">
                    <x-checkbox label="Empresa Ativa" id='active' name="active"/>
                    <x-checkbox label="Filtrar Apenas 200" id='only_200' name="only_200"/>
                    <x-checkbox label="Apenas 200 com segundos" id='only_200_wp' name="only_200_wp"/>

                </div>
                <div class="space-y-6">
                    <x-checkbox label="Deletar Apenas 404" id='delete_only_404' name="delete_only_404"/>
                    <x-checkbox label="Obter 487" id='code_487' name="code_487"/>
                    <x-checkbox label="Obter 487 com tentativas" id='code_487_wp' name="code_487_wp"/>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-6 flex items-center justify-end gap-x-6">
        <button type="button" class="text-sm font-semibold leading-6 text-gray-900" onclick="window.dispatchEvent(new CustomEvent('close-modal', { detail: 'create_company_modal' }))">
            Cancel
        </button>
        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
       const form = document.getElementById('company-form');

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
