<?php

namespace App\Exports;

use App\Models\Marca;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MarcasExport implements FromView, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Marca::all();
    // }

    public function view(): View
    {
        return view('exports.marcas', [
            'data' => Marca::all()
        ]);
    }

    public function map($marca): array
    {
        return [
            $marca->id,
            $marca->nombre,
            \Carbon\Carbon::parse($marca->created_at)->format('d/m/Y H:i:s'), // Formateando la fecha
        ];
    }
}
