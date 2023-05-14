<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CreditPrice extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'credit_prices';
    use HasFactory;
    public function orders(){
        return $this->hasMany(Order::class);
    } 
}
