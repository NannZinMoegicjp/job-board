<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderConfirmation;
use App\Models\Company;
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
        $orderCon->admin_id = session('adminId');
        $orderCon->order_id = $id;
        $orderCon->is_confirmed = true;
        $d=strtotime("today");
        $orderCon->save();
        $order = Order::find($id);
        $company = Company::find($order->company_id);
        $company->no_of_credit += $order->no_of_credit;  
        $company->save();        
        return redirect('/admin/payment')->with("status","accepted order");
    }
    public function rejectOrder($id){
        $orderCon = new OrderConfirmation();
        $orderCon->admin_id = session('adminId');
        $orderCon->order_id = $id;
        $orderCon->is_confirmed = false;
        $d=strtotime("today");
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
