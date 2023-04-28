<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Order;
use App\Models\OrderConfirmation;
class AdminDashBoardController extends Controller
{
    public function index(){
        $companyCount = Company::where('deleted_at', NULL)->count();
        $confirmedOrderCount = OrderConfirmation::where('deleted_at', NULL)->count();
        $confirmedOrderedIds = OrderConfirmation::select('order_id')->get();
        $awaitingOrderCount = Order::whereNotIn('id', $confirmedOrderedIds)->where('deleted_at', NULL)->count();
        $count = ["companies"=>$companyCount,"conOrders"=>$confirmedOrderCount,"awaitOrders"=>$awaitingOrderCount];
        return view('dashboard')->with('count',$count);
    }
}
