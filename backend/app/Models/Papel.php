<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Papel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'papel';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'permissao',
    ];
}
