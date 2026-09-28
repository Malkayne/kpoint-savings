<?php

namespace App\Http\Controllers\Rep\Auth;

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
    protected $redirectTo = '/rep/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:rep')->except('logout');
    }

    public function username(){
          return 'username';
    }

       protected function guard(){
          return Auth::guard('rep');
       }

      protected function attemptLogin(Request $request){
          return Auth::guard('rep')->attempt(
            $this->credentials($request)
            // $request->has('remember')
          );
      }

      protected function authenticated(Request $request, $user)
      {
          if (!org_is_active($user->org_id)) {
              $this->guard()->logout();

              return redirect()->back()->withErrors([
                  $this->username() => 'This organisation is not active.',
              ]);
          }

          $request->session()->forget(['acting_org_id', 'acting_as_superadmin']);
      }


       public function showLoginForm()
       {
         return view('repEnd.auth.login');
       }

       public function logout(Request $request)
       {
        $this->guard('rep')->logout();
        return redirect('/rep/login');
       }

}
