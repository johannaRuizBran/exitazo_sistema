<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable = [
        'numeroPersona', 'nombrePersona', 'direccion', 'telefono', 'limiteDeCredito', 'saldoActual',
    ];

}
