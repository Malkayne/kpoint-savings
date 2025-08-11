<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Auth;


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
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function username(){
          return 'username';
    }

       protected function guard(){
          return Auth::guard('admin');
       }

      protected function attemptLogin(Request $request){
          return Auth::guard('admin')->attempt(
            $this->credentials($request),
            $request->has('remember')
          );
      }


       public function showLoginForm()
       {
         return view('adminend.auth.login');
       }

       public function logout(Request $request)
       {
        $this->guard('admin')->logout();
        return redirect('/admin/login');
       }

}
