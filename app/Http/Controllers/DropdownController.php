<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\State;
use Illuminate\Support\Facades\Response;
class DropdownController extends Controller
{
    public function fetchCities($id)
    {
        $data = City::where("state_id", $id)->get(["name", "id"]);
        // print $data['cities'];
        // print_r($data['cities']);
        // $data = Student::where("id", $id)
        //     ->get();
        return response()->json($data);
    }
}
