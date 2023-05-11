<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:employer')->except('logout');
        $this->middleware('guest:jobseeker')->except('logout');
    }
    protected function authenticated(Request $request, $user)
    {
        
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->input('remember', false);     
        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            return redirect('/admin'); 
        } 
        if(Auth::guard('employer')->attempt($credentials, $remember)) {
            
            return redirect('/employer');           
        }
        if(Auth::guard('jobseeker')->attempt($credentials, $remember)) {
            return redirect('/');           
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();        
    }
}
