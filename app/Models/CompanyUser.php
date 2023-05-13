<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
class CompanyUser extends Authenticatable
{
    protected $table='companies';
    protected $guard = 'employer';
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contact_person', 'email', 'password','phone','company_name','logo','websitelink','no_of_employee','established_date'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function isEmployer(){
        return true;
    }
}
