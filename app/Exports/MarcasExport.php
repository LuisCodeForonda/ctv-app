<?php

namespace App\Exports;

use App\Models\Marca;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MarcasExport implements FromCollection, WithHeadingRow, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Marca::all();
    }

    public function model(array $row)
    {
        return new Marca([
            'codigo'  => $row['id'],
            'nombre' => $row['nombre'],
            'fecha de creacion'    => $row['created_at'],
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
