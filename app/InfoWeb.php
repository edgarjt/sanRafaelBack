<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoWeb extends Model
{
    protected $table = 'infoWeb';

    protected $primaryKey = 'inf_id';

    protected $fillable = [
        'inf_logo', 'inf_telefono', 'inf_email', 'inf_historia', 'inf_dir', 'inf_hora', 'inf_facebook',  'inf_instagram', 'inf_twitter', 'fk_id_user'
    ];
}
