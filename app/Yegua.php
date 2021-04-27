<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Yegua extends Model
{
    protected $table = 'yegua';

    protected $primaryKey = 'yeg_id';

    protected $fillable = [
        'yeg_nombre', 'yeg_capa', 'yeg_nacimiento', 'yeg_semental', 'yeg_altura', 'yeg_fot1', 'yeg_fot2', 'yeg_fot3', 'yeg_video', 'yeg_trofeo', 'fk_id_user', 'fk_id_finca'
    ];
}
