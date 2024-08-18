@php
    $entity = 'web' !== Session::get('entity') ? Session::get('entity') : 'user' ;
    $company_route = $entity === 'admin' ? 'admin.company.list' : 'reseller.company.list';
@endphp
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/{{ $entity }}/dashboard">
                        <img src="/img/logo_maisvoip.png" alt="Maisvoip Telecom VoIP" class="h-8 w-auto" style="opacity:.8">
                    </a>
                </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route($entity.'.dashboard')" :active="request()->routeIs($entity.'.dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
                @if (isset($entity) && $entity !== 'user')
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route($company_route)" :active="request()->routeIs($company_route)">
                            {{ __('Empresas') }}
                        </x-nav-link>
                    </div>
                @endif
                @if ($entity === 'admin')
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>Relatórios</div>

                                <div class="ms-1">

                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('admin.report.usage')">
                                {{ __('Relatório de Uso') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('admin.report.unused')">
                                {{ __('Relatório Fora de Uso') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('admin.report.queue')">
                                {{ __('Fila de Processamento') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('admin.configurations')" :active="request()->routeIs('admin.configurations')">
                        {{ __('Configurações') }}
                    </x-nav-link>
                </div>
                @endif
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Session::get('name') }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('user.logout') }}">
                            @csrf
                            <x-dropdown-link :href="route($entity.'.logout')"
                                onclick="event.preventDefault();
                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route($entity.'.dashboard')" :active="request()->routeIs($entity.'dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>
        @if (isset($entity) && $entity !== 'user')
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route($company_route)" :active="request()->routeIs($company_route)">
                {{ __('Empresas') }}
            </x-responsive-nav-link>
        </div>
        @endif
        @if ($entity === 'admin')
        <div class="pt-4 pb-1 border-t border-gray-200">

            <div class="mt-3 space-y-1">

                <x-responsive-nav-link :href="route($entity.'.logout')"
                    onclick="event.preventDefault();
                    this.closest('form').submit();">
                    {{ __('Fila de Tratamento') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route($entity.'.logout')"
                    onclick="event.preventDefault();
                    this.closest('form').submit();">
                    {{ __('Relatório de Uso') }}
                </x-responsive-nav-link>
            </div>
        </div>
        @endif
        @if ($entity === 'admin')
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('admin.configurations')" :active="request()->routeIs('admin.configurations')">
                {{ __('Configurações') }}
            </x-responsive-nav-link>
        </div>
        @endif

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Session::get('name') }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Session::get('name') }}</div>
            </div>

            <div class="mt-3 space-y-1 bg-gray-400 rounded-md">

                <!-- Authentication -->
                <form method="POST" action="{{ route($entity.'.logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route($entity.'.logout')"
                        onclick="event.preventDefault();
                         this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>