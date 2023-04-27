<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderConfirmation;
class OrderController extends Controller
{
    public function index(){
        $confirmedOrders = OrderConfirmation::all();
        return view('payment-confirm')->with('confirmedOrders',$confirmedOrders);
    }
    public function getAwaitingOrder(){
        $confirmedOrderedIds = OrderConfirmation::select('order_id')->get();
        $awaitingOrders = Order::whereNotIn('id', $confirmedOrderedIds)->get();
        return view('order')->with('awaitingOrders',$awaitingOrders);
    }
}
