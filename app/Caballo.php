<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caballo extends Model
{
    protected $table = 'caballo';

    protected $primaryKey = 'cab_id';

    protected $fillable = [
        'cab_nombre', 'cab_capa', 'cab_nacimiento', 'cab_semental', 'cab_fot1', 'cab_fot2', 'cab_fot3', 'cab_video', 'fk_id_user', 'fk_id_finca'
    ];

}
