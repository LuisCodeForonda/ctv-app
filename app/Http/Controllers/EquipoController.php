<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\EquiposExport;
use Maatwebsite\Excel\Facades\Excel;

class EquipoController extends Controller
{
    public function export($format)
    {
        switch ($format) {
            case 'excel':
                return Excel::download(new EquiposExport, 'equipos.xlsx', \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'pdf':
                //return Excel::download(new MarcasExport, 'marcas.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
                break;
            case 'csv':
                return Excel::download(new EquiposExport, 'equipos.csv', \Maatwebsite\Excel\Excel::CSV);
                break;
            default:
                
                break;
        }
    }
}
