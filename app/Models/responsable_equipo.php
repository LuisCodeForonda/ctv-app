<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class responsable_equipo extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function equipo(){
        return $this->belongsTo(Equipo::class, 'equipo_id');
    }

    public function responsable(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
