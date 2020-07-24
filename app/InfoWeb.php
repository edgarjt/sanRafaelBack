<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoWeb extends Model
{
    protected $table = 'infoWeb';

    protected $primaryKey = 'inf_id';

    protected $fillable = [
        'inf_logo', 'inf_telefono', 'inf_email', 'fk_id_user'
    ];
}
