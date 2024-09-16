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

    public function responsable(){
        return $this->belongsTo(Responsable::class);
    }
}
