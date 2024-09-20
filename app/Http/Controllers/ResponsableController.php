<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ResponsablesExport;
use Maatwebsite\Excel\Facades\Excel;

class ResponsableController extends Controller
{
    public function export($format)
    {
        switch ($format) {
            case 'excel':
                return Excel::download(new ResponsablesExport, 'responsables.xlsx', \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'pdf':
                //return Excel::download(new MarcasExport, 'marcas.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
                break;
            case 'csv':
                return Excel::download(new ResponsablesExport, 'responsables.csv', \Maatwebsite\Excel\Excel::CSV);
                break;
            default:
                
                break;
        }
    }
}
