<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\PaymentAccount;
class PaymentMethodController extends Controller
{
    public function index(){
        $data = PaymentMethod::all();
        $accounts = PaymentAccount::all();
        return view('payment-methods')->with('data',$data)->with('accounts',$accounts);
    }
    public function insert(Request $request){
        $data = new PaymentMethod();
        $validator = validator(request()->all(), [
            'image' => 'required|mimes:jpeg,jpg,svg,gif,png|max:2048',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $data->name = $request->input('name');
        $logoImg = time() . "." . $request->file('image')->getClientOriginalName();
        $request->image->move(public_path('images/payment_methods'),$logoImg);
        $data->image = $logoImg;
        $data->save();
        return redirect('/admin/payment-methods')->with('status','added payment method successfully');
    }
    public function update(Request $request,$id){
        $data = PaymentMethod::find($id);        
        $data->name = $request->input('updateName');
        if($request->hasFile('updateImage')){
            $validator = validator(request()->all(), [
                'image' => 'mimes:jpeg,jpg,svg,gif,png|max:2048',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            if(file_exists(public_path('images/payment_methods/'.$data->image))){
                unlink(public_path('images/payment_methods/'.$data->image));
            }
            $logoImg = time() . "." . $request->file('updateImage')->getClientOriginalName();
            $request->updateImage->move(public_path('images/payment_methods'),$logoImg);
            $data->image = $logoImg;
        }        
        $data->save();
        return redirect('/admin/payment-methods')->with('status','updated payment method successfully');
    }
    public function delete($id){
        $data = PaymentMethod::find($id);        
        if(file_exists(public_path('images/payment_methods/'.$data->image))){
            unlink(public_path('images/payment_methods/'.$data->image));
        }
        $data->delete();
        return redirect('/admin/payment-methods')->with('status','deleted payment method successfully');        
    }
    public function insertPaymentAccount(Request $request){
        $payment_account = new PaymentAccount();
        $payment_account->account_name = $request->input('accName');
        $payment_account->account_no = $request->input('accNo');
        $payment_account->payment_method_id = $request->input('payMethod');
        $payment_account->save();
        return redirect('/admin/payment-methods')->with('status','added account successfully');
    }
    public function updatePaymentAccount(Request $request,$id){
        $payment_account = PaymentAccount::find($id);
        if($request->has('updateAccName')){
            $payment_account->account_name = $request->input('updateAccName');
        }
        if($request->has('updateAccNo')){
            $payment_account->account_no = $request->input('updateAccNo');
        }
        if($request->has('updatePayMethod')){
            $payment_account->payment_method_id = $request->input('updatePayMethod');
        }
        $payment_account->save();
        return redirect('/admin/payment-methods')->with('status','updated account successfully');
    }
    public function deletePaymentAccount($id){
        $payment_account = PaymentAccount::find($id);
        $payment_account->delete();
        return redirect('/admin/payment-methods')->with('status','deleted account successfully');
    }
}
