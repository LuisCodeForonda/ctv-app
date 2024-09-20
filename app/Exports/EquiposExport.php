<?php

namespace App\Exports;

use App\Models\Equipo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EquiposExport implements FromView, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Equipo::all();
    // }

    public function view(): View
    {
        return view('exports.equipos', [
            'data' => Equipo::all()
        ]);
    }

    public function map($equipo): array
    {
        return [
            $equipo->id,
            $equipo->descripcion,
            $equipo->observaciones,
            $equipo->modelo,
            $equipo->serie,
            $equipo->serietec,
            $equipo->estado,
            $equipo->area,
            $equipo->ubicacion,
            $equipo->responsable->nombre,
            $equipo->marca->nombre,
            $equipo->equipo_id,
            \Carbon\Carbon::parse($equipo->created_at)->format('d/m/Y H:i:s'), // Formateando la fecha
        ];
    }
}
