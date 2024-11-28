<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    //relacion de muchos a muchos
    public function responsables(){
        return $this->belongsToMany(User::class);
    }
}
