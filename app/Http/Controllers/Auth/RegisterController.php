<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Rep;
use App\Models\Wallet;
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
        $serialCode = '100';
        $year = date('Y');
        $lastUser = User::withoutTenantScope()->orderBy('id', 'desc')->first();

        if ($lastUser !== null && $lastUser->accNum) {
            $serial = substr($lastUser->accNum, 7);
        } else {
            $serial = '040';
        }

        $accCode = (int) $serial;

        do {
            $accCode++;
            $accNum = $serialCode.$year.$accCode;
        } while (User::withoutTenantScope()->where('accNum', $accNum)->exists());

        return $accNum;
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
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
            'rep_username' => 'required|string|max:50',
            'signature' => 'required|file',
            'profile_pix' => 'required|file'
        ]);

        // die('Registration is currently disabled. lollllllllll');

        $accNum = $this->accNumGen();

        $rep = Rep::withoutTenantScope()
            ->where('username', $request->rep_username)
            ->where('status', 'active')
            ->first();

        if (!$rep || !org_is_active($rep->org_id)) {
            return back()->withErrors([
                'rep_username' => 'Referral code is not valid.',
            ])->withInput();
        }
        
        
            $upload_dir = 'public/Images/Signatures/';

            $file = $request->file('signature');

             if($file){
                 $imgTmp = $file->getClientOriginalName();
          
              $imgExt = $file->getClientOriginalExtension();
        
              $image_link = time().'_'.rand(1000,9999).'.'.$imgExt;
        
                  $file->move($upload_dir,$image_link);
             }


            $upload_dir_profile = 'public/Images/ProfilePics/';
            
            $profileFile = $request->file('profile_pix');
            
            if ($profileFile) {
                $profileOriginalName = $profileFile->getClientOriginalName();
                $profileExt = $profileFile->getClientOriginalExtension();
                $profileImageName = time() . '_' . rand(1000, 9999) . '.' . $profileExt;
            
                $profileFile->move($upload_dir_profile, $profileImageName);
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
            'rep_id' => $rep->id,
            'org_id' => $rep->org_id,
            'signature' => $image_link,
            'profile_pix'  => $profileImageName
        ];

        $user = User::withoutTenantScope()->create($userData);

        if ($user) {
            Wallet::withoutTenantScope()->create([
                'org_id' => $rep->org_id,
                'user_id' => $user->id,
                'amount' => 0,
            ]);

            auth()->login($user);
            return redirect($this->redirectTo);
        } else {
            return back()->withErrors(['error' => 'Registration failed. Please try again.']);
        }
    }
}
