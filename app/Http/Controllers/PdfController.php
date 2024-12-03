<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Mantenimiento;
use App\Models\Solicitud;
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

    public function mantenimiento($id){
        $mantenimiento = Mantenimiento::findOrFail($id);

        $pdf = Pdf::loadView('pdf.mantenimiento', compact('mantenimiento'));
        return $pdf->stream();
    }

    public function reporte($id){
        $solicitud = Solicitud::findOrFail($id);

        $pdf = Pdf::loadView('pdf.reporte', compact('solicitud'));
        return $pdf->stream();
    }

    public function equipo($id){
        $equipo = Equipo::findOrFail($id);

        $pdf = Pdf::loadView('pdf.equipo', compact('equipo'));
        return $pdf->stream();
    }
}
