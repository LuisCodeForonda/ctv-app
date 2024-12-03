<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index(){
        $total = Equipo::all()->count();
        $standby = Equipo::where('estado', '=', '1')->count();
        $operativo = Equipo::where('estado', '=', '2')->count();
        $mantenimiento = Equipo::where('estado', '=', '3')->count();
        $obsoleto = Equipo::where('estado', '=', '4')->count();

        $data = [$standby/$total*100, $operativo/$total*100, $mantenimiento/$total*100, $obsoleto/$total*100];
        return view('dashboard', compact('data'));
    }
}
