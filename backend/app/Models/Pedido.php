<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pedido';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'idUsuario',
        'destino',
        'dataIda',
        'dataVolta',
        'status',
    ];
}