@php
    $modal_name_admin = "create_admin_modal";
    $modal_name_reseller = "create_admin_modal";
@endphp


<div class='flex items-center justify-center py-12 via-blue-800 to-blue-300 bg-gradient-to-br'>
    <div class='w-full max-w-7xl px-10 py-8 bg-white rounded-lg shadow-xl'>
        <div class='mx-auto space-y-6'>

            <div class="flex flex-col mb-6">
                <div class="flex flex-col gap-4">
                    <!-- tabs -->
                    <div class="tabs flex flex-col w-full">
                        <!-- tabs header -->
                        <div class="relative flex flex-row items-center justify-start">
                            <button data-type="tabs" data-target="#tab-1" class="w-full md:w-auto h-16 px-4 py-2 flex flex-col justify-end items-center gap-1 hover:bg-surface-100 dark:hover:bg-surfacedark-100 active-tab">
                                <span class="material-symbols-outlined">id_card</span>
                                <p class="text-sm tracking-[.00714em]">Perfil</p>
                            </button>
                            <button data-type="tabs" data-target="#tab-2" class="w-full md:w-auto h-16 px-4 py-2 flex flex-col justify-end items-center gap-1 hover:bg-surface-100 dark:hover:bg-surfacedark-100">
                                <span class="material-symbols-outlined">manage_accounts</span>
                                <p class="text-sm tracking-[.00714em]">Administradores</p>
                            </button>
                            <button data-type="tabs" data-target="#tab-3" class="w-full md:w-auto h-16 px-4 py-2 flex flex-col justify-end items-center gap-1 hover:bg-surface-100 dark:hover:bg-surfacedark-100">
                                <span class="material-symbols-outlined">storefront</span>
                                <p class="text-sm tracking-[.00714em]">Revenda</p>
                            </button>
                            <!-- indicator -->
                            <div role="indicator" class="absolute bottom-0 transition-all duration-200 ease-in-out bg-blue-600 dark:bg-blue-400 h-0.5"></div>
                        </div>
                        <hr class="border-gray-200 dark:border-gray-700">

                        <div id="tab-1" class="tab-content">
                            <x-content-tabs title="Gerencie os dados da sua conta">
                                <x-slot name="content_tab">
                                    <x-form-admin-profile />
                                </x-slot>
                            </x-content-tabs>
                        </div>

                        <div id="tab-2" class="tab-content hidden">
                            <x-content-tabs title="Faça a gestão dos administradores do sistema.">
                                <x-slot name="content_tab">
                                    <x-admins-list :data="$admins"/>
                                </x-slot>
                            </x-content-tabs>
                        </div>
                        <div id="tab-3" class="tab-content hidden">
                            <x-content-tabs title="Faça a gestão dos usuários de revenda">
                                <x-slot name="content_tab">
                                    <x-resellers-list :data="$resellers"/>
                                </x-slot>
                            </x-content-tabs>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Estilo para a aba ativa */
    .active-tab {
        background-color: #f3f4f6;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    /* Ajuste da largura do indicador */
    [role='indicator'] {
        width: calc(100% / 3); /* Indicador abrange um terço da largura total */
        left: 0; /* Remove qualquer padding à esquerda */
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const tabs = document.querySelectorAll("[data-type='tabs']");
    const contents = document.querySelectorAll(".tab-content");
    const indicator = document.querySelector("[role='indicator']");

    tabs.forEach((tab, index) => {
        tab.addEventListener("click", function() {
            // Remove active class from all tabs and hide all contents
            tabs.forEach(t => t.classList.remove("active-tab"));
            contents.forEach(c => c.classList.add("hidden"));

            // Add active class to clicked tab and show corresponding content
            tab.classList.add("active-tab");
            const target = document.querySelector(tab.dataset.target);
            target.classList.remove("hidden");

            // Move indicator to the selected tab
            const tabWidth = tab.offsetWidth;
            indicator.style.width = `${tabWidth}px`;
            indicator.style.left = `${tab.offsetLeft}px`;  // Posiciona o indicador sob a aba ativa
        });
    });
});
</script>
