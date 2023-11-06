<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'eventos';
    
    static $rules=[

        'id_user'=>'required',
        'title'=>'required',
        'start'=>'required',
        'end'=>'required'
    ];

    protected $fillable = [
        'id_user',
        'title',
        'start',
        'end',
    ];
}
