<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'email',
        'password',
        'fecha_nacimiento',
        'dui',
        'nit',
        'telefono',
        'direccion',
        'estado',
        'foto_perfil',
        'tipo_usuario',

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
        'password' => 'hashed',
    ];

    protected $attributes = [
        'estado' => 1, // Valor predeterminado para estado
    ];
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    public function getProfileUrlAttribute()
    {
        $url = $this->foto_perfil ? asset('storage/perfiles/' . $this->foto_perfil) : asset('storage/perfiles/default-profile.png');
        Log::info('Profile URL: ' . $url);
        return $url;
    }
}
