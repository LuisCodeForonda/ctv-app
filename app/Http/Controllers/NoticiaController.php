<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestStatus\Notice;

class NoticiaController extends Controller
{
    public function index(){
        return "hello";
    }
}
