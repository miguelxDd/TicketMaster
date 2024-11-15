<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'evento_id',
        'localidad_id',
        'cantidad',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }

    public function localidad()
    {
        return $this->belongsTo(Localidad::class);
    }

    public function boleto()
    {
        return $this->hasOne(Boleto::class, 'reserva_id');
    }
}