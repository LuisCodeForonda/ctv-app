<?php

namespace App\Exports;

use App\Models\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ResponsablesExport implements FromView, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Responsable::all();
    // }

    public function view(): View
    {
        return view('exports.responsables', [
            'data' => Responsable::all()
        ]);
    }

    //funcion para modificar los datos de salida de cada registro
    public function map($responsable): array
    {
        return [
            $responsable->id,
            $responsable->nombre,
            $responsable->cargo,
            $responsable->carnet,
            $responsable->celular,
            \Carbon\Carbon::parse($responsable->created_at)->format('d/m/Y H:i'), // Formateando la fecha
        ];
    }
}
