<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CreditPrice;

class CreditPriceController extends Controller
{
    //get all prices of credit price
    public function index(){
        $data = CreditPrice::orderBy('created_at','desc')->get();
        return view('pricing')->with('data',$data);
    }
    //insert price(when no price in table)
    public function insertPrice(Request $request){
        $newprice = new CreditPrice();
        $newprice->price = $request->input('price');
        $newprice->created_at = date('Y-m-d H:i:s');
        $newprice->updated_at = null;
        $newprice->save();
        return redirect('/admin/pricing');
    }
    //update price
    public function updatePrice(Request $request,$id){
        $price = CreditPrice::find($id);
        if($price->price == $request->input('newPrice')){
            return back()->with('error','your current price already '.$price->price);
        }
        $newprice = new CreditPrice();
        $newprice->price = $request->input('newPrice');
        $newprice->created_at = date('Y-m-d H:i:s');
        $price->updated_at = date('Y-m-d H:i:s');
        $newprice->updated_at = null;
        $newprice->save();
        $price->save();
        return redirect('/admin/pricing');
    }
}
