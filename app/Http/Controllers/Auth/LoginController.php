<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
    }

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'], 'status' => 1)))
        {
            if(auth()->user()->hasRole('Admin')){
                return redirect()->route('home')->with('success','Login Sukses');
            }
            elseif(auth()->user()->hasRole('Manajer')){
                return redirect()->route('home')->with('success','Login Sukses');
            }elseif(auth()->user()->hasRole('Pegawai')){
                return redirect()->route('menugudang')->with('success','Login Sukses');
            }else{
                return redirect()->route('home')->with('success','Login Sukses');
            }
        }
        else{
            return redirect()->route('login')->with('error','email atau password salah!!');
        }
    }
}
