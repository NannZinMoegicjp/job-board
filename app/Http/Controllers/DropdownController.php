<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\State;
use App\Models\PaymentAccount;
use Illuminate\Support\Facades\Response;
class DropdownController extends Controller
{
    //get cities by state id
    public function fetchCities($id)
    {
        $data = City::where("state_id", $id)->get(["name", "id"]);
        return response()->json($data);
    }
    //get payment account by id
    public function fetchPaymentAccounts($id)
    {
        $data = PaymentAccount::where("payment_method_id", $id)->get(["account_name","account_no", "id"]);
        return response()->json($data);
    }
}
