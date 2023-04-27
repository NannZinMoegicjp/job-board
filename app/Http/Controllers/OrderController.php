<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderConfirmation;
class OrderController extends Controller
{
    public function index(){
        $confirmedOrderedIds = OrderConfirmation::select('order_id')->get();
        $confirmedOrders = Order::whereIn('id', $confirmedOrderedIds)->get();
        return view('payment-confirm')->with('confirmedOrders',$confirmedOrders);
    }
    public function getAwaitingOrder(){
        $confirmedOrderedIds = OrderConfirmation::select('order_id')->get();
        $awaitingOrders = Order::whereNotIn('id', $confirmedOrderedIds)->get();
        return view('payment-confirm')->with('awaitingOrders',$awaitingOrders);
    }
}
