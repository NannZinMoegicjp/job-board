<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderConfirmation;
class OrderController extends Controller
{
    public function index(){
        $confirmedOrders = OrderConfirmation::all();
        // echo $confirmedOrders;
        return view('payment-confirm')->with('confirmedOrders',$confirmedOrders);
    }
    public function getAwaitingOrder(){
        $confirmedOrderedIds = OrderConfirmation::select('order_id')->get();
        $awaitingOrders = Order::whereNotIn('id', $confirmedOrderedIds)->get();
        return view('order')->with('awaitingOrders',$awaitingOrders);
    }
    public function acceptOrder($id){
        $orderCon = new OrderConfirmation();
        //need to get logged in admin id
        $orderCon->admin_id = 1;
        $orderCon->order_id = $id;
        $orderCon->is_confirmed = true;
        $d=strtotime("today");
        // $orderCon->created_at = date("Y-m-d h:i:s", $d);
        $orderCon->save();
        return redirect('/admin/payment');
    }
    public function rejectOrder($id){
        $orderCon = new OrderConfirmation();
        //need to get logged in admin id
        $orderCon->admin_id = 1;
        $orderCon->order_id = $id;
        $orderCon->is_confirmed = false;
        $d=strtotime("today");
        // $orderCon->created_at = date("Y-m-d h:i:s", $d);
        $orderCon->save();
        return redirect('/admin/payment');
    }
    public function confirmedOrderDetails($id){
        $corder =OrderConfirmation::find($id);
        return view('order-details')->with('corder',$corder);
    }
    public function awaitingOrderDetails($id){
        $order =Order::find($id);
        return view('order-details')->with('order',$order);
    }
}
