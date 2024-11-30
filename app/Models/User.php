<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'enabled',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    //relacion de uno a uno
    public function perfil(){
        return $this->hasOne(UserProfile::class, 'user_id');
    }

    //uno a muchos
    public function asignados(){
        return $this->hasMany(UserEquipo::class);
    }

    //relacion de muchos a muchos
    public function equipos(){
        return $this->belongsToMany(Equipo::class, 'user_equipos');
    }

    public function solicitudes(){
        return $this->hasMany(Solicitud::class);
    }

}
