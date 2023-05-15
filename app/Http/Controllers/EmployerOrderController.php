<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderConfirmation;
use App\Models\Company;
use App\Models\CreditPrice;
class EmployerOrderController extends Controller
{
    //get all credit transitions
    public function getOrders(){
        $oids = Order::select('id')->where('company_id', auth()->guard('employer')->id())->get();
        $confirmedOrders = OrderConfirmation::whereIn('order_id',$oids)->orderBy('created_at','desc')->get();
        $confirmedOrderedIds = OrderConfirmation::select('order_id')->orderBy('created_at','desc')->get();
        $awaitingOrders = Order::whereNotIn('id', $confirmedOrderedIds)->where('company_id', auth()->guard('employer')->id())->get();
        return view('Employer.order')->with('awaitingOrders',$awaitingOrders)->with('confirmedOrders',$confirmedOrders);
    }
    //view confirmed payment details
    public function confirmedOrderDetails($id){
        $corder =OrderConfirmation::find($id);
        return view('Employer.order-details')->with('corder',$corder);
    }
    //view pending payment details
    public function awaitingOrderDetails($id){
        $order =Order::find($id);
        return view('Employer.order-details')->with('order',$order);
    }
}
