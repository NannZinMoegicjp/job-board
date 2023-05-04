<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployerController extends Controller
{
    public function index(Request $request){
        $request->session()->put('id', 1);
        $request->session()->put('name', 'cocacola');
        $request->session()->put('imgPath', '1683166385.o9SXyF4kPWv_4nhtaCnNLKCh5ySN9sCJBF3l61hQuN6ixDmWm0SLAa4tCISBfcceb7xiEIOir20= (1).png');
        return view('Employer.index');
    }
}
