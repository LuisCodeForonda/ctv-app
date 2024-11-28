<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Equipo;

new #[Layout('layouts.app')] class extends Component {
    //objeto
    public Equipo $equipo;

    public function mount($slug)
    {
        $this->equipo = Equipo::where('slug', $slug)->first();
    }

    public function with()
    {
        return [
            'qrcode' => QrCode::size(256)->generate('https://admin.ctvbolivia.com/equipo/' . $this->equipo->slug),
        ];
    }
}; ?>

<div class="dark:text-slate-200">
    @slot('header')
        <h1 class="font-bold"><a href="{{ route('equipos.index') }}" wire:navigate>Equipos</a> > informacion >
            {{ $equipo->slug }}</h1>
    @endslot

    <div class="p-2 dark:bg-gray-800 rounded-md">
        <div class="grid grid-cols-3 gap-2 py-2">
            <div class="col-span-2 space-y-2">
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <h2 class="font-bold">Descripcion</h2>
                        <p>{{ $equipo->descripcion }}</p>
                    </div>
                    <div>
                        <h2 class="font-bold">Observaciones</h2>
                        <p>{{ $equipo->observaciones }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-4 gap-2">
                    <div class="flex">
                        <h2 class="font-bold mr-2">Marca:</h2>
                        <p>{{ $equipo->marca->nombre ?? '' }}</p>
                    </div>
                    <div class="flex">
                        <h2 class="font-bold mr-2">Modelo:</h2>
                        <p>{{ $equipo->modelo }}</p>
                    </div>
                    <div class="flex">
                        <h2 class="font-bold mr-2">Serie:</h2>
                        <p>{{ $equipo->serie }}</p>
                    </div>
                    <div class="flex">
                        <h2 class="font-bold mr-2">Serie TEC:</h2>
                        <p>{{ $equipo->serietec }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-4 gap-2">
                    <div class="flex">
                        <h2 class="font-bold mr-2">Area:</h2>
                        <p>{{ $equipo->area !== '' ? $equipo->area : 'null' }}</p>
                    </div>
                    <div class="col-span-2 flex">
                        <h2 class="font-bold mr-2">Ubicacion:</h2>
                        <p>{{ $equipo->ubicacion !== '' ? $equipo->ubicacion : 'null' }}</p>
                    </div>
                    <div class="flex">
                        <h2 class="font-bold mr-2">Estado:</h2>
                        <p class="{{ 'text-' . config('constants.colores')[$equipo->estado] . '-600' }} font-bold">
                            {{ config('constants.estados')[$equipo->estado] }}
                        </p>
                    </div>
                </div>

                @if ($equipo->responsable_id !== null)
                    <div class="grid grid-cols-4 gap-2">
                        <div class="flex">
                            <h2 class="font-bold mr-2">A cargo de:</h2>
                            <p>{{ $equipo->responsable->nombre }}</p>
                        </div>
                        <div class="flex">
                            <h2 class="font-bold mr-2">Cargo:</h2>
                            <p>{{ $equipo->responsable->cargo }}</p>
                        </div>
                        <div class="flex">
                            <h2 class="font-bold mr-2">Celular:</h2>
                            <p>{{ $equipo->responsable->celular }}</p>
                        </div>
                        <div class="flex">
                            <h2 class="font-bold mr-2">Carnet:</h2>
                            <p>{{ $equipo->responsable->carnet }}</p>
                        </div>
                    </div>
                @endif

            </div>
            <div class="flex flex-col items-center gap-2">
                <h2 class="font-bold text-xl">Codigo QR</h2>
                <div id="container">
                    {!! $qrcode !!}
                </div>
                <x-primary-button onclick="downloadSVG()">Descargar QR</x-primary-button>
            </div>
        </div>
    </div>


    <livewire:componentes.equipo-componente :equipo="$equipo" />

    <livewire:archivos.equipo-componente :equipo="$equipo" />

    <livewire:mantenimientos.equipo-componente :equipo="$equipo" />

    <script>
        function downloadSVG() {
            const svg = document.getElementById('container').innerHTML;
            const blob = new Blob([svg.toString()]);
            const element = document.createElement("a");
            element.download = "w3c.svg";
            element.href = window.URL.createObjectURL(blob);
            element.click();
            element.remove();
        }
    </script>
</div>
