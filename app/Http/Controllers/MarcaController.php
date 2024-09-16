<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\MarcasExport;
use Maatwebsite\Excel\Facades\Excel;

class MarcaController extends Controller
{
    public function export($format)
    {
        switch ($format) {
            case 'excel':
                return Excel::download(new MarcasExport, 'marcas.xlsx', \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'pdf':
                //return Excel::download(new MarcasExport, 'marcas.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
                break;
            case 'csv':
                return Excel::download(new MarcasExport, 'marcas.csv', \Maatwebsite\Excel\Excel::CSV);
                break;
            default:
                
                break;
        }
    }
}
