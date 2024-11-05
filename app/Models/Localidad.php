<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    use HasFactory;

    protected $table = 'localidades'; // Especificar el nombre de la tabla

    protected $fillable = [
        'evento_id',
        'nombre',
        'precio',
        'capacidad',
        'asientos_disponibles',
    ];

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}