<?php

namespace App\Exports;

use App\Models\Componente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ComponentesExport implements FromView, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Componente::all();
    // }

    public function view(): View
    {
        return view('exports.componentes', [
            'data' => Componente::all()
        ]);
    }

    public function map($componente): array
    {
        return [
            $componente->id,
            $componente->descripcion,
            $componente->observaciones,
            $componente->modelo,
            $componente->serie,
            $componente->cantidad,
            $componente->marca->nombre,
            $componente->equipo_id,
            \Carbon\Carbon::parse($componente->created_at)->format('d/m/Y H:i:s'), // Formateando la fecha
        ];
    }
}
