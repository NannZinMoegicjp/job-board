<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
class JobSeekerUser extends Authenticatable
{
    protected $table='job_seekers';
    protected $guard = 'jobseeker';
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'email', 'password',
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
