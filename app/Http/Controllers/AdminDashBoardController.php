<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
class AdminDashBoardController extends Controller
{
    public function index(){
        $companyCount = Company::where('deleted_at', NULL)->count();
        return view('dashboard')->with('companyCount',$companyCount);
    }
}
