<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <link rel="stylesheet" href="{{ asset('build\assets\app-01043519.css')}}"> --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    {{-- <script src="{{ asset('build/assets/app-09f45680.js')}}"></script> --}}
    
    <style>
        .box {
            width: 3.5rem;
        }

        .box-1 {
            transition: width .3s;
        }

        .show_menu {
            transition: height .3s;
        }

        .icon_arrow {
            transition: all .3s;
        }

        .arrow .icon_arrow {
            transform: rotate(90deg);
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="flex flex-row min-h-screen bg-gray-100 dark:bg-gray-900 dark:text-slate-100">

        <div class="box-1 bg-gray-800 dark:bg-gray-800 min-w-12 w-56 h-screen ">


            <!-- logo -->

            <div class="text-center">
                <a href="{{ route('dashboard') }}" class="block text-nowrap py-4 px-1">
                    <img src="{{ asset('images/logo.jpg') }}" alt="" class="h-10 w-12 inline-block mr-2">
                    <h1 class="inline-block align-middle text-4xl font-bold text-white">SISTEC</h1>
                </a>
            </div>


            <!-- menu de navegacion -->
            <ul class="relative">
                <li class="">
                    <span class="block px-4 text-slate-400 text-sm">Administracion</span>
                </li>
                @can('user')
                    <li class="">
                        <a href="{{ route('usuarios.index') }}" wire:navigate class="cursor-pointer flex px-4 py-2 text-slate-200 hover:text-white hover:bg-slate-300/30 {{ request()->routeIs('usuarios.index') ? 'bg-slate-300/30' : '' }}">
                            <img src="{{ asset('icons/users.svg')}}" alt="" class="pr-2">
                            <span
                                class="block"> Usuarios</span>
                        </a>
                    </li>
                @endcan
                @can('rol')
                    <li class="">
                        <a href="{{ route('roles.index') }}" wire:navigate class="cursor-pointer flex px-4 py-2 text-slate-200 hover:text-white hover:bg-slate-300/30 {{ request()->routeIs('roles.index') ? 'bg-slate-300/30' : '' }}">
                            <img src="{{ asset('icons/user-detail.svg')}}" alt="" class="pr-2">
                            <span
                                class="block">Roles</span>
                        </a>
                    </li>
                @endcan
                <li class="">
                    <span class="block px-4 text-slate-400 text-sm">Administracion de equipos</span>
                </li>
                @can('marca')
                    <li class="">
                        <a href="{{ route('marcas.index') }}" wire:navigate class="cursor-pointer flex px-4 py-2 text-slate-200 hover:text-white hover:bg-slate-300/30 {{ request()->routeIs('marcas.index') ? 'bg-slate-300/30' : '' }}">
                            <img src="{{ asset('icons/marca.svg')}}" alt="" class="pr-2">
                            <span
                                class="block ">Marcas</span>
                        </a>
                    </li>
                @endcan
                @can('categoria')
                    <li class="">
                        <a href="{{ route('categorias.index') }}" wire:navigate class="cursor-pointer flex px-4 py-2 text-slate-200 hover:text-white hover:bg-slate-300/30 {{ request()->routeIs('categorias.index') ? 'bg-slate-300/30' : '' }}">
                            <img src="{{ asset('icons/categoria.svg')}}" alt="" class="pr-2">
                            <span
                                class="block ">Categorias</span>
                        </a>
                    </li>
                @endcan

                @can('componente')
                    <li class="">
                        <a href="{{ route('componentes.index') }}" wire:navigate class="cursor-pointer flex px-4 py-2 text-slate-200 hover:text-white hover:bg-slate-300/30 {{ request()->routeIs('componentes.index') ? 'bg-slate-300/30' : '' }}">
                            <img src="{{ asset('icons/componente.svg')}}" alt="" class="pr-2">
                            <span
                                class="block ">Componente</span>
                        </a>
                    </li>
                @endcan
                @can('equipo')
                    <li class="">
                        <a href="{{ route('equipos.index') }}" wire:navigate class="cursor-pointer flex px-4 py-2 text-slate-200 hover:text-white hover:bg-slate-300/30 {{ request()->routeIs('equipos.index') ? 'bg-slate-300/30' : '' }}">
                            <img src="{{ asset('icons/chip.svg')}}" alt="" class="pr-2">
                            <span
                                class="block">Equipos</span>
                        </a>
                    </li>
                @endcan


                @can('equipo')
                    <li class="">
                        <a href="{{ route('asignaciones.index') }}" wire:navigate class="cursor-pointer flex px-4 py-2 text-slate-200 hover:text-white hover:bg-slate-300/30 {{ request()->routeIs('asignaciones.index') ? 'bg-slate-300/30' : '' }}">
                            <img src="{{ asset('icons/compartir.svg')}}" alt="" class="pr-2">
                            <span
                                class="block">Asignaciones</span>
                        </a>
                    </li>
                @endcan

                @can('equipo')
                    <li class="">
                        <a href="{{ route('mantenimientos.index') }}" wire:navigate class="cursor-pointer flex px-4 py-2 text-slate-200 hover:text-white hover:bg-slate-300/30 {{ request()->routeIs('mantenimientos.index') ? 'bg-slate-300/30' : '' }}">
                            <img src="{{ asset('icons/mantenimiento.svg')}}" alt="" class="pr-2">
                            <span
                                class="block">Mantenimientos</span>
                        </a>
                    </li>
                @endcan

                @can('equipo')
                    <li class="">
                        <a href="{{ route('reportes.index') }}" wire:navigate class="cursor-pointer flex px-4 py-2 text-slate-200 hover:text-white hover:bg-slate-300/30 {{ request()->routeIs('reportes.index') ? 'bg-slate-300/30' : '' }}">
                            <img src="{{ asset('icons/mantenimiento.svg')}}" alt="" class="pr-2">
                            <span
                                class="block">Reportes</span>
                        </a>
                    </li>
                @endcan
                {{-- <li class="overflow-hidden">
                    <button
                        class="list-button py-2 w-full flex items-center text-slate-400 hover:text-white hover:bg-slate-300/30">
                        <img src="{{ asset('icons/users.svg') }}" alt="" class="px-4 mr-1">
                        <span class="grow text-left">Acceso</span>
                        <img src="{{ asset('icons/chevron-right.svg') }}" alt="" class="px-4 icon_arrow">
                    </button>
                    <ul class="h-0 pl-10 show_menu">

                        @can('user')
                            <li class="border-l-2">
                                <a href="{{ route('usuarios.index') }}" wire:navigate class="cursor-pointer">
                                    <span
                                        class="block px-4 py-2 text-slate-400 hover:text-white hover:bg-slate-300/30 {{ request()->routeIs('marcas.index') ? 'text-white bg-slate-300/30' : '' }}">Usuarios</span>
                                </a>
                            </li>
                        @endcan
                        @can('rol')
                            <li class="border-l-2">
                                <a href="{{ route('roles.index') }}" wire:navigate class="cursor-pointer ">
                                    <span
                                        class="block px-4 py-2 text-slate-400 hover:text-white hover:bg-slate-300/30 {{ request()->routeIs('componente.index') ? 'text-white bg-slate-300/30' : '' }}">Roles</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li> --}}


                <li class="">
                    <span class="block px-4 text-slate-400 text-sm">Equipamiento asignado</span>
                </li>
                <li class="">
                    <a href="{{ route('equipamiento.index') }}" wire:navigate class="cursor-pointer flex px-4 py-2 text-slate-200 hover:text-white hover:bg-slate-300/30 {{ request()->routeIs('equipamiento.index') ? 'bg-slate-300/30' : '' }}">
                        <img src="{{ asset('icons/chip.svg')}}" alt="" class="pr-2">
                        <span
                            class="block">
                            Equipamiento</span>
                    </a>
                </li>

                <li class="">
                    <a href="{{ route('solicitudes.index') }}" wire:navigate class="cursor-pointer flex px-4 py-2 text-slate-200 hover:text-white hover:bg-slate-300/30 {{ request()->routeIs('solicitudes.index') ? 'bg-slate-300/30' : '' }}">
                        <img src="{{ asset('icons/reportes.svg')}}" alt="" class="pr-2">
                        <span
                            class="block">Reportes
                            enviados</span>
                    </a>
                </li>

            </ul>
        </div>

        <div class="box-2 w-96 h-screen grow overflow-y-scroll relative">
            <div
                class="bg-slate-50 dark:bg-gray-900 sticky z-10 p-4 top-0 left-0 flex items-center justify-between border-b-2">
                <div class="flex">
                    <img src="{{ asset('icons/menu.svg') }}" alt=""
                        class="block cursor-pointer toogle_menu ">

                    <h2 class="ml-4">{{ $header }}</h2>
                </div>

                <!-- Settings Dropdown -->
                <livewire:layout.navigation />
            </div>

            <!-- Page Content -->
            <main class="relative bg-white dark:bg-gray-900 p-4 w-full min-h-full ">
                {{ $slot }}
            </main>
        </div>





    </div>

    <!-- Page Heading -->
    {{-- @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif --}}
    <script>
        var toogle_menu = document.querySelector('.toogle_menu');
        var items = document.querySelectorAll('.list-button')

        toogle_menu.addEventListener('click', () => {
            document.querySelector('.box-1').classList.toggle('box')
        })

        items.forEach((item) => {
            item.addEventListener('click', () => {
                item.classList.toggle("arrow");
                var submenu = item.nextElementSibling;
                var height = 0;
                if (submenu.clientHeight == "0") {
                    height = submenu.scrollHeight;
                }
                submenu.style.height = `${height}px`;
            });
        })
    </script>

    {{-- <link rel="stylesheet" href="{{ asset('build\assets\app-09f45680.js')}}"> --}}
</body>

</html>
