<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'slider';

    protected $primaryKey = 'sli_id';

    protected $fillable = [
        'sli_nombre', 'sli_link'
    ];
}
