<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function detalle(){
        return $this->hasMany(DetalleMantenimiento::class);
    }

    public function equipo(){
        return $this->belongsTo(Equipo::class);
    }
}
