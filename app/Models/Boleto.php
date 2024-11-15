<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boleto extends Model
{
    use HasFactory;

    protected $fillable = [
        'reserva_id',
        'codigo_boleto',
        'estado_boleto',
    ];

    public function compra()
    {
        return $this->belongsTo(Compra::class, 'reserva_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}