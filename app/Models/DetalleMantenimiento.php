<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleMantenimiento extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function mantenimiento(){
        return $this->belongsTo(Mantenimiento::class);
    }
}
