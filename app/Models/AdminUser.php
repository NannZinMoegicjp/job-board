<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
class AdminUser extends Authenticatable
{
    protected $table='admins';
    protected $guard = 'admins';
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
