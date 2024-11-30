<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use UnitEnum;

class Equipo extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function marca(){
        return $this->belongsTo(Marca::class);
    }

    public function intervalo(){
        return $this->hasOne(IntervaloMantenimiento::class);
    }

    public function solicitudes(){
        return $this->hasMany(Solicitud::class);
    }

    public function asignado(){
        return $this->hasMany(UserEquipo::class);
    }

    //relacion de muchos a muchos
    public function users(){
        return $this->belongsToMany(User::class, 'user_equipos');
    }
}
