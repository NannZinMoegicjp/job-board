<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderConfirmation;
use App\Models\Company;
use App\Models\CreditPrice;
class EmployerOrderController extends Controller
{
    public function getOrders(){
        $oids = Order::select('id')->where('company_id', auth()->guard('employer')->id())->get();
        $confirmedOrders = OrderConfirmation::whereIn('order_id',$oids)->orderBy('created_at','desc')->get();
        $confirmedOrderedIds = OrderConfirmation::select('order_id')->orderBy('created_at','desc')->get();
        $awaitingOrders = Order::whereNotIn('id', $confirmedOrderedIds)->where('company_id', auth()->guard('employer')->id())->get();
        return view('Employer.order')->with('awaitingOrders',$awaitingOrders)->with('confirmedOrders',$confirmedOrders);
    }
    public function confirmedOrderDetails($id){
        $corder =OrderConfirmation::find($id);
        $creditPrice = CreditPrice::withTrashed()->find($corder->order->credit_price_id);
        return view('Employer.order-details')->with('corder',$corder)->with('creditPrice',$creditPrice);
    }
    public function awaitingOrderDetails($id){
        $order =Order::find($id);
        $creditPrice = CreditPrice::withTrashed()->find($order->credit_price_id);
        return view('Employer.order-details')->with('order',$order)->with('creditPrice',$creditPrice);
    }
}
