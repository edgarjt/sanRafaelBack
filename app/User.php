<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'use_id';

    protected $fillable = [
        'use_nombre', 'use_app', 'use_apm', 'use_email', 'use_password', 'use_telefono', 'use_role'
    ];

    protected $hidden = [
        'use_password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
