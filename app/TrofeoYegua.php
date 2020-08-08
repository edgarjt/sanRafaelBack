<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrofeoYegua extends Model
{
    protected $table = 'trofeoYegua';

    protected $primaryKey = 'trf_id';

    protected $fillable = [
        'trf_clave', 'trf_titulo', 'trf_foto', 'trf_fecha', 'trf_descripcion', 'fk_id_caballo'
    ];
}
