<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function orderConfirmation(){
        return $this->hasOne(OrderConfirmation::class);
    }
    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function creditPrice(){
        return $this->belongsTo(CreditPrice::class);
    }
    public function paymentAccount(){
        return $this->belongsTo(PaymentAccount::class);
    }
}
