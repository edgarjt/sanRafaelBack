<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finca extends Model
{
    protected $table = 'finca';

    protected $primaryKey = 'fin_id';

    protected $fillable = [
        'fin_nombre', 'fin_direccion', 'fin_horario'
    ];
}
