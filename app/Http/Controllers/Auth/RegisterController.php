<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Rep;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/userend/dashboard';

    public function __construct()
    {
        $this->middleware('guest');
    }

    // Generate unique account number
    protected function accNumGen()
    {
        $serialCode = 100;
        $year = date('Y');
        $lastUser = User::latest()->first();
        if ($lastUser !== null) {
            $scode = $lastUser->accNum;
            $SNcode = substr($scode, 7, 9);
        } else {
            $SNcode = '040';
        }
        $accCode = $SNcode + 1;
        $accNum = $serialCode . $year . $accCode;
        return $accNum;
    }

    public function showRegistrationForm()
    {
        $reps = Rep::where('status', 'active')->get();
        return view('auth.register', ['refs' => $reps]);
    }

    public function register(Request $request)
    {
        // die('Registration is currently disabled. Please contact support for assistance.');
        $request->validate([
            'name' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users',
            'email' => 'nullable|email|max:100|unique:users',
            'phone' => 'required|string|max:20',
            'profession' => 'nullable|string|max:100',
            'education' => 'nullable|string|max:100',
            'address' => 'required|string',
            'dob' => 'nullable|date',
            'nok_name' => 'required|string|max:100',
            'nok_phone' => 'required|string|max:20',
            'nok_relationship' => 'required|string|max:50',
            'password' => 'required|string|confirmed',
            'rep_id' => 'required|integer|exists:reps,id',
            'signature' => 'file'
        ]);

        // die('Registration is currently disabled. lollllllllll');

        $accNum = $this->accNumGen();
        
        
            $upload_dir = 'public/Images/Signatures/';

     $file = $request->file('signature');

     if($file){
         $imgTmp = $file->getClientOriginalName();
  
      $imgExt = $file->getClientOriginalExtension();

      $image_link = time().'_'.rand(1000,9999).'.'.$imgExt;

          $file->move($upload_dir,$image_link);
     }

        $userData = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email ?? null,
            'accNum' => $accNum,
            'wallet_balance' => 0.00,
            'phone' => $request->phone,
            'profession' => $request->profession ?? null,
            'education' => $request->education ?? null,
            'address' => $request->address,
            'dob' => $request->dob ?? null,
            'image' => null,
            'status' => 'active',
            'nok_name' => $request->nok_name,
            'nok_phone' => $request->nok_phone,
            'nok_relationship' => $request->nok_relationship,
            'password' => Hash::make($request->password),
            'rep_id' => $request->rep_id,
            'signature' => $image_link
        ];

        $user = User::create($userData);

        if ($user) {
            auth()->login($user);
            return redirect($this->redirectTo);
        } else {
            return back()->withErrors(['error' => 'Registration failed. Please try again.']);
        }
    }
}
