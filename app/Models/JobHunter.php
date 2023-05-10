<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
class JobHunter extends Authenticatable
{
    protected $table='job_seekers';
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
