<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'eventos'; // Especificar el nombre de la tabla

    protected $fillable = [
        'organizador_id',
        'nombre',
        'descripcion',
        'fecha',
        'ubicacion',
        'estado',
    ];

    public function localidades()
    {
        return $this->hasMany(Localidad::class);
    }
}