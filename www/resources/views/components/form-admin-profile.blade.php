<form>
    <div class="space-y-12">


      <div class="border-b border-gray-900/10 pb-12">

        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-3">
            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nome</label>
            <div class="mt-2">
              <input type="text" name="name" id="name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>

          <div class="sm:col-span-3">
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">E-mail</label>
            <div class="mt-2">
                <input id="email" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
          </div>

          <div class="sm:col-span-3">
            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Senha:</label>
            <div class="mt-2">
                <input id="password" name="password" type="password" autocomplete="new-password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
          </div>

          <div class="sm:col-span-3">
            <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Confirme a Senha</label>
            <div class="mt-2">
                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
          </div>



        </div>
      </div>

    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
      <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
      <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
    </div>
  </form>


{{-- <form action="" method="POST">
    @csrf
    @method('PUT')
    <div class="flex flex-col gap-4">
        <div class="flex flex-col gap-1">
            <label for="name" class="text-gray-700">Nome</label>
            <input type="text" name="name" id="name" value="" class="border border-gray-300 rounded p-2">
        </div>
        <div class="flex flex-col gap-1">
            <label for="email" class="text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="" class="border border-gray-300 rounded p-2">
        </div>
        <div class="flex flex-col gap-1">
            <label for="password" class="text-gray-700">Senha</label>
            <input type="password" name="password" id="password" class="border border-gray-300 rounded p-2">
        </div>
        <div class="flex flex-col gap-1">
            <label for="password_confirmation" class="text-gray-700">Confirmar Senha</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="border border-gray-300 rounded p-2">
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Salvar
        </button>
    </div>
</form>
 --}}
