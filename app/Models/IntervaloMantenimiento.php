<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntervaloMantenimiento extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'equipo_id'];

    public function equipo(){
        return $this->belongsTo(Equipo::class);
    }
}