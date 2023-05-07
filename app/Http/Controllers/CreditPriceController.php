<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CreditPrice;

class CreditPriceController extends Controller
{
    public function index(){
        $prices = CreditPrice::all();
        return view('pricing')->with('data',$prices);
    }
    public function insertPrice(Request $request){
        $newprice = new CreditPrice();
        $newprice->price = $request->input('price');
        $newprice->created_at = date('Y-m-d H:i:s');
        $newprice->updated_at = null;
        $newprice->save();
        return redirect('/admin/pricing');
    }
    public function updatePrice(Request $request,$id){
        $price = CreditPrice::find($id);
        if($price->price == $request->input('newPrice')){
            return back()->with('error','your current price already '.$price->price);
        }
        $price->updated_at =  date('Y-m-d H:i:s');
        $price->save();
        $newprice = new CreditPrice();
        $newprice->price = $request->input('newPrice');
        $newprice->created_at = date('Y-m-d H:i:s');
        $newprice->updated_at = null;
        $newprice->save();
        return redirect('/admin/pricing');
    }
}
