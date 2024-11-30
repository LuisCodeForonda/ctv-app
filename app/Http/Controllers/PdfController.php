<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    
    public function usuario_equipo($id){
        $user = User::findOrFail($id);

        $pdf = Pdf::loadView('pdf.equipos-asignados', compact('user'));
        return $pdf->stream();
    }
}
