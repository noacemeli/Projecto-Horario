<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = 'solicitudes';

    protected $fillable = [
        'id_user',
        'titulo',
        'fecha_inicio',
        'fecha_final',
        'aprobada',
    ];
}
