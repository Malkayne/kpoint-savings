<?php

namespace App\Http\Controllers\Rep;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use App\Models\Rep;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Transaction;
use App\Models\pendTransactions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\ContributionPlan;
use App\Models\Contribution;

class DefaultController extends Controller
{

    public function __construct()
    {
      //  $adminDetails = Auth::user('rep');
    }

    public function index()
    {
        $rep = Auth::guard('rep')->user();
        $repId = $rep->id;
        
        // Get rep's users
        $users = User::where('rep_id', $repId)->get();
        $totalUsers = $users->count();
        $activeUsers = $users->where('status', 'active')->count();
        
        // Get rep's contribution plans
        $plans = ContributionPlan::where('rep_id', $repId)->get();
        $activePlans = $plans->where('status', 'active')->count();
        $completedPlans = $plans->where('status', 'completed')->count();
        $totalPlans = $plans->count();
        
        // Get transactions for rep's users
        $userIds = $users->pluck('id');
        $transactions = Transaction::whereIn('user_id', $userIds)->get();
        $totalTransactions = $transactions->count();
        $totalCredits = $transactions->where('type', 'credit')->sum('amount');
        $totalDebits = $transactions->where('type', 'debit')->sum('amount');
        
        // Get recent transactions
        $recentTransactions = Transaction::with('user')
            ->whereIn('user_id', $userIds)
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->get();
        
        // Get recent contributions
        $recentContributions = \App\Models\Contribution::whereHas('plan', function($query) use ($repId) {
            $query->where('rep_id', $repId);
        })->with(['plan.user'])->orderBy('created_at', 'DESC')->limit(5)->get();
        
        // Calculate total wallet balance of rep's users
        $totalUserWallet = $users->sum('wallet_balance');
        
        // Get rep's wallet balance
        $repWallet = $rep->wallet_balance;
        
        // Calculate plan progress
        $totalPlanAmount = $plans->sum('amount');
        $totalContributed = \App\Models\Contribution::whereHas('plan', function($query) use ($repId) {
            $query->where('rep_id', $repId);
        })->sum('amount');
        $planProgress = $totalPlanAmount > 0 ? ($totalContributed / $totalPlanAmount) * 100 : 0;
        
        return view('repEnd.dashboard', [
            'title' => 'Dashboard',
            'rep' => $rep,
            'totalUsers' => $totalUsers,
            'activeUsers' => $activeUsers,
            'activePlans' => $activePlans,
            'completedPlans' => $completedPlans,
            'totalPlans' => $totalPlans,
            'totalTransactions' => $totalTransactions,
            'totalCredits' => $totalCredits,
            'totalDebits' => $totalDebits,
            'recentTransactions' => $recentTransactions,
            'recentContributions' => $recentContributions,
            'planProgress' => $planProgress,
            'totalPlanAmount' => $totalPlanAmount,
            'totalContributed' => $totalContributed,
            'totalUserWallet' => $totalUserWallet,
            'repWallet' => $repWallet
        ]);
    }


    public function users() {
        $repId = Auth::guard('rep')->id(); // Get current rep's ID
        $users = User::where('rep_id', $repId)
                    ->where('status', 'active')
                    ->get();
        return view('repEnd.users', ['title' => 'Users', 'users' => $users]);
    }

    public function editUser(User $user){

      return view('repEnd.editUser',['title'=>'Edit User','userDetails'=>$user]);

    }

    public function userDetails(User $user) {
      // for security!
      if ($user->rep_id !== auth()->user('rep')->id) {
          abort(403, 'Unauthorized action.');
      }
      $contributionPlans = $user->contributionPlans()->with('contributions')->get();
      $transactions = $user->transactions()->get();
      return view('repEnd.userDetails', compact('user', 'contributionPlans', 'transactions'));
    }

public function changeUserPassword(User $user){

  return view('repEnd.changeUserPassword',['title'=>'Change User Password','userDetails'=>$user]);

}


public function updateUserPassword(Request $request,User $userID){

        $request->validate([
          'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);

        $firstname = $userID->firstName;
        $lastname = $userID->lastName;
        $mssg = $firstname." ".$lastname."'s"." password has been changed";

        $userID->password = Hash::make($request->password);

       $updateUserPassword = $userID->save();

       if($updateUserPassword){
         return redirect(route('rep.users') )->with('success', $mssg);
       }else{
         return redirect(route('rep.users') )->with('error', 'Something went wrong,please try again');
       }
}

public function updateUserProfile(Request $request,User $userID){

  $name = $request->firstName.' '.$request->lastName;
  $message = $name.' account has been Successfully updated';


       $upload_dir = 'public/Images/Users/';

     $file = $request->file('image');

     if($file){
         $imgTmp = $file->getClientOriginalName();
    if($imgTmp !== $userID->imgLink){
      $imgExt = $file->getClientOriginalExtension();

      $image_link = time().'_'.rand(1000,9999).'.'.$imgExt;

          $file->move($upload_dir,$image_link);

          $userID->update([
            'imgLink' => $image_link
          ]);

}
     }

     if(($request->accNum) !== ($userID->accNum)){
        $this->updateUsersms($name,$request->accNum,$request->phoneNumber);
     }

      $userID->update($request->all());
  return redirect(route('rep.users'))->with('success',$message);

}



private function updateUsersms($name,$accNum,$num){
        $message = "Dear ".$name.",Welcome on board with us.Your SMYL account Number is ".$accNum."\n Kindly meet any of our agents around you to drop your authentic details";

  $request = "";
  $param["api_token"] = "k3JXHTyCXv7utY4WJavoI0C4r830luhKmyi5U1E4tFVBpO0xi8X8Eobhh0fK";
  $param["from"] = "SMYL";
  $param["to"] =  $num;
  $param["body"] = $message;


  foreach($param as $key=>$val) //traverse through each member of the param array
  {
  $request .= $key . "=" . urlencode($val); //we have to urlencode the values
  $request .= '&'; //append the ampersand (&) sign after each paramter/value pair
  }
  $len = strlen($request) - 1;
  $request = substr($request, 0, $len); //

  //$url = "https://mobilenig.com/API/bills/dstv_test?"; //The URL given in the documentation without parameters
  $url = "https://www.bulksmsnigeria.com/api/v1/sms/create?"; //The URL given in the documentation without parameters
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "$url$request");
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); //return as a variable
  $response = curl_exec($ch);
  curl_close($ch);

}


    public function profile()
    {
        $rep = Auth::guard('rep')->user();
        $repId = $rep->id;

        // Total users referred by this rep
        $totalUsers = \App\Models\User::where('rep_id', $repId)->count();

        // Total active plans for this rep
        $totalPlans = \App\Models\ContributionPlan::where('rep_id', $repId)
            ->where('status', 'active')
            ->count();

        // Get all user IDs for this rep
        $userIds = \App\Models\User::where('rep_id', $repId)->pluck('id');

        // Total transactions for rep's users
        $totalTransactions = \App\Models\Transaction::whereIn('user_id', $userIds)->count();

        // Recent transactions (latest 10)
        $recentTransactions = \App\Models\Transaction::with('user')
            ->whereIn('user_id', $userIds)
            ->orderBy('created_at', 'DESC')
            ->limit(10)
            ->get();

        return view('repEnd.profile', [
            'title' => 'Profile',
            'rep' => $rep,
            'totalUsers' => $totalUsers,
            'totalPlans' => $totalPlans,
            'totalTransactions' => $totalTransactions,
            'recentTransactions' => $recentTransactions,
        ]);
    }

    public function editProfile(Rep $rep){

      return view('repEnd.editProfile',['repDetails'=> $rep,'title'=>'Update Profile']);

    }

    public function updateProfile(Request $request, \App\Models\Rep $repID) {
        $authRep = Auth::guard('rep')->user();
        if ($repID->id !== $authRep->id) abort(403, 'Unauthorized action.');
        $request->validate([
            'name' => 'required|string|max:100',
            'username' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:20',
            'image' => 'nullable|image|max:2048',
        ]);
        $data = $request->only(['name', 'username', 'email']);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imgExt = $file->getClientOriginalExtension();
            $image_link = time().'_'.rand(1000,9999).'.'.$imgExt;
            $file->move('public/Images/Reps/', $image_link);
            $data['image'] = $image_link;
        }
        $repID->update($data);
        return redirect()->route('rep.profile')->with('success', 'Profile updated successfully.');
    }


    public function transactions(){
        $repId = Auth::guard('rep')->id();
        $userIds = User::where('rep_id', $repId)->pluck('id');
        $transactions = \App\Models\Transaction::with('user')
            ->whereIn('user_id', $userIds)
            ->orderBy('created_at', 'DESC')
            ->get();
        return view('repEnd.transactions', compact('transactions'));
    }
    
    
         public function userTransaction(Request $req){

            // $transactions = Transaction::all();
            $transactions = Transaction::where('user_id',$req->uid)->orderBy('id', 'DESC')->get();
            return view('repEnd.transactions',['transactions' => $transactions,'title' => 'transactions']);
    }
    
              public function Ptransactions(){
                
            //     $usersIDs = Rep::find(auth::user('rep')->id)->user()->pluck('id')->toArray();
                
            // $Ptransactions = pendTransactions::whereIn('user_id',$usersIDs)->orderBy('created_at', 'DESC')->get();

             $Ptransactions = pendTransactions::orderBy('id', 'DESC')->get();
            return view('repEnd.Ptransactions',['Ptransactions' => $Ptransactions,'title' => 'Pending Credits']);
    }


    public function usersWallet() {
        $repId = Auth::guard('rep')->id();
        $users = User::with(['contributionPlans', 'transactions'])
            ->where('rep_id', $repId)
            ->get();
        return view('repEnd.usersWallet', compact('users'));
    }


    public function DebitOrCreditUser($transType,User $userID){

            return view('repEnd.creditorDebitUser',['transType' => $transType,'user'=>$userID,'title' => $transType]);

    }

    public function updateUserWallet($transType, User $userID, Request $request) {
        $repId = Auth::guard('rep')->id();
        if ($userID->rep_id !== $repId) abort(403, 'Unauthorized action.');
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'narration' => 'nullable|string',
        ]);
        $amount = $request->amount;
        $narration = $request->narration;
        if ($transType == 'credit') {
            $userID->wallet_balance += $amount;
            $userID->save();
            \App\Models\Transaction::create([
                'user_id' => $userID->id,
                'rep_id' => $repId,
                'wallet_type' => 'user',
                'type' => 'credit',
                'amount' => $amount,
                'description' => $narration,
            ]);
            return redirect()->route('rep.usersWallet')->with('success', 'Wallet credited successfully.');
        } else {
            if ($userID->wallet_balance < $amount) {
                return redirect()->route('rep.usersWallet')->with('error', 'Insufficient funds.');
            }
            $userID->wallet_balance -= $amount;
            $userID->save();
            \App\Models\Transaction::create([
                'user_id' => $userID->id,
                'rep_id' => $repId,
                'wallet_type' => 'user',
                'type' => 'debit',
                'amount' => $amount,
                'description' => $narration,
            ]);
            return redirect()->route('rep.usersWallet')->with('success', 'Wallet debited successfully.');
        }
    }
    
      private function creditUser($userID,$amount){

       $userPendWallet = $userID::find($userID->id)->pTrans;

         if($userPendWallet !== null){
           $oldAmount =  $userPendWallet->amount;
           $newAmount = $amount + $oldAmount;
         }else{
           $newAmount = 0 + $amount;
                  }

    //   $creditUser = pendTransactions::updateOrCreate(
    // ['user_id' => $userID->id],
    // ['transType' => 'credit','rep_id'=>auth::user('rep')->id,'amount' => $newAmount]
    //   );
       
         $creditUser = pendTransactions::create(
    ['user_id' => $userID->id,
    'transType' => 'credit','rep_id'=>auth::user('rep')->id,'amount' => $amount]
       );

         // $about = "your account has been credited ".$amount;
         // $transType = "credit";
         // $user_id = $userID->id;
         // $amount =  $amount;
         // $refKey =  "SMYL||".time();

     // $this->saveTransaction($about,$transType,$user_id,$amount,$refKey);
        if($creditUser){
     $rtnMesssage = $userID->firstName.' '.$userID->lastName."'s"." account has been credited"." ".$amount;
   }else{
      $rtnMesssage = "something went wrong";
   }
     return $rtnMesssage;
    }


    private function debitUser($userID,$amount){
       $userWallet = $userID::find($userID->id)->wallet;
         if($userWallet !== null){
          $oldAmount =  $userWallet->amount;
          $newAmount = $oldAmount -  $amount;
         }else{
      $newAmount = 0 - $amount;
         }

      $creditUser = Wallet::updateOrCreate(
    ['user_id' => $userID->id],
    ['amount' => $newAmount]
      );

         $about = "your account has been debited ".$amount;
         $transType = "debit";
         $user_id = $userID->id;
         $amount =  $amount;
         $refKey =  "SMYL||".time();
         $ref = User::find($userID->id)->referral;
         $repName = Auth::user('rep')->name;
         $cName = User::find($userID->id)->firstName.' '.User::find($userID->id)->lastName;
         $cAccNum = User::find($userID->id)->accNum;
         $refNum = $refKey;
         $actRep = Rep::find($ref)->name;
         
        //  print_r($actRep); die();
        $this->saveTransaction($about,$transType,$user_id,$amount,$refKey);

         $this->updateAdminsms($repName,$cName,$cAccNum,$refNum,$actRep); 
  
     $rtnMesssage = $userID->firstName.' '.$userID->lastName."'s"." account has been debited"." ".$amount;
     return $rtnMesssage;
     
    }
    
    private function updateAdminsms($repName,$cName,$cAccNum,$refNum,$actRep){
        $message = "Rep Name: ".$repName."\nCustomer Name: ".$cName."\nCustomer Account Number: ".$cAccNum."\nReference Number: ".$refNum."\nActual Rep: ".$actRep;
   $snedNum = "08166035923";
   $devNumb = "09038472927";
  $request = "";
  $param["api_token"] = "k3JXHTyCXv7utY4WJavoI0C4r830luhKmyi5U1E4tFVBpO0xi8X8Eobhh0fK";
  // real   k3JXHTyCXv7utY4WJavoI0C4r830luhKmyi5U1E4tFVBpO0xi8X8Eobhh0fK
  //72eA3YKF8cjJoLAFWoeB7QGWuwugsq83M2kIeboS0T7bqSFP4Ms9WNgho4KK
  $param["from"] = "SMYL";
  $param["to"] = $snedNum;
  $param["body"] = $message;


  foreach($param as $key=>$val) //traverse through each member of the param array
  {
  $request .= $key . "=" . urlencode($val); //we have to urlencode the values
  $request .= '&'; //append the ampersand (&) sign after each paramter/value pair
  }
  $len = strlen($request) - 1;
  $request = substr($request, 0, $len); //

  //$url = "https://mobilenig.com/API/bills/dstv_test?"; //The URL given in the documentation without parameters
  $url = "https://www.bulksmsnigeria.com/api/v1/sms/create?"; //The URL given in the documentation without parameters
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "$url$request");
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); //return as a variable
  $response = curl_exec($ch);
  curl_close($ch);

}

  /*  private function creditUser($userID,$amount){

       $userWallet = $userID::find($userID->id)->wallet;
         if($userWallet !== null){
          $oldAmount =  $userWallet->amount;
          $newAmount = $amount + $oldAmount;
         }else{
      $newAmount = 0 + $amount;
         }

      $creditUser = Wallet::updateOrCreate(
    ['user_id' => $userID->id],
    ['amount' => $newAmount]
       );

         $about = "your account has been credited ".$amount;
         $transType = "credit";
         $user_id = $userID->id;
         $amount =  $amount;
         $refKey =  "SMYL||".time();

     $this->saveTransaction($about,$transType,$user_id,$amount,$refKey);

     $rtnMesssage = $userID->firstName.' '.$userID->lastName."'s"." account has been credited"." ".$amount;
     return $rtnMesssage;
    }
*/

    private function saveTransaction($about,$transType,$user_id,$amount,$refKey){
      $user_id = User::find($user_id);
      $accNum = $user_id->accNum;
      $splitACC = (substr($accNum, 3, 9));
      $acc = "***".$splitACC;
      $bal = User::find($user_id->id)->wallet->amount;
      $num =  $user_id->phoneNumber;
      $this->sendSMS($transType,$acc,$amount,$bal,$num);
       return Transaction::create([
       'about' => $about,
       'transType' => $transType,
       'user_id' => $user_id->id,
       'amount' => $amount,
       'refKey' => $refKey,
       'is_rep' => 1,
       'rep_id' => auth::user('rep')->id
       ]);
    }

    private function sendSMS($transType,$acc,$amount,$bal,$num){
        date_default_timezone_set('Africa/Lagos');
       $time = date("d/m/Y h:i A");
        $message = ucfirst($transType)."\nAcc: ".$acc."\nAmt: NGN".number_format($amount)."\nTime: ".$time."\nTotal Bal: NGN".number_format($bal);
      $request = "";
      $param["api_token"] = "k3JXHTyCXv7utY4WJavoI0C4r830luhKmyi5U1E4tFVBpO0xi8X8Eobhh0fK";
      $param["from"] = "SMYL";
      $param["to"] =  $num;
      $param["body"] = $message;


      foreach($param as $key=>$val) //traverse through each member of the param array
      {
      $request .= $key . "=" . urlencode($val); //we have to urlencode the values
      $request .= '&'; //append the ampersand (&) sign after each paramter/value pair
      }
      $len = strlen($request) - 1;
      $request = substr($request, 0, $len); //

      //$url = "https://mobilenig.com/API/bills/dstv_test?"; //The URL given in the documentation without parameters
      $url = "https://www.bulksmsnigeria.com/api/v1/sms/create?"; //The URL given in the documentation without parameters
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "$url$request");
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); //return as a variable
      $response = curl_exec($ch);
      curl_close($ch);

    }


public function deleteUser( User $user
    )
    {
    $user->delete();
    return redirect(route('admin.users') )->with('error', 'User Account has been deleted');
   }

    // PLANS CRUD & CONTRIBUTIONS FOR REPS
    public function plans() {
        $repId = Auth::guard('rep')->id();
        $plans = ContributionPlan::with(['user', 'contributions'])
            ->where('rep_id', $repId)
            ->orderBy('created_at', 'DESC')
            ->get();
        $users = User::where('rep_id', $repId)->where('status', 'active')->get();
        return view('repEnd.plans', compact('plans', 'users'));
    }

    public function createPlan(Request $request) {
        $repId = Auth::guard('rep')->id();
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:100',
            'amount' => 'required|numeric|min:1',
            'duration' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);
        $user = User::where('id', $request->user_id)->where('rep_id', $repId)->firstOrFail();
        $plan = ContributionPlan::create([
            'user_id' => $user->id,
            'rep_id' => $repId,
            'title' => $request->title,
            'amount' => $request->amount,
            'description' => $request->description,
            'duration' => $request->duration,
            'start_date' => now(),
            'status' => 'active',
        ]);
        return redirect()->route('rep.plans')->with('success', 'Plan created successfully.');
    }

    public function updatePlan(Request $request, ContributionPlan $plan) {
        $repId = Auth::guard('rep')->id();
        if ($plan->rep_id !== $repId) abort(403, 'Unauthorized action.');
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:100',
            'amount' => 'required|numeric|min:1',
            'duration' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);
        $user = User::where('id', $request->user_id)->where('rep_id', $repId)->firstOrFail();
        $plan->update([
            'user_id' => $user->id,
            'title' => $request->title,
            'amount' => $request->amount,
            'description' => $request->description,
            'duration' => $request->duration,
        ]);
        return redirect()->route('rep.plans')->with('success', 'Plan updated successfully.');
    }

    public function deletePlan(ContributionPlan $plan) {
        $repId = Auth::guard('rep')->id();
        if ($plan->rep_id !== $repId) abort(403, 'Unauthorized action.');
        $plan->contributions()->delete();
        $plan->delete();
        return redirect()->route('rep.plans')->with('success', 'Plan deleted successfully.');
    }

    public function planDetails(ContributionPlan $plan) {
        $repId = Auth::guard('rep')->id();
        if ($plan->rep_id !== $repId) abort(403, 'Unauthorized action.');
        $plan->load(['user', 'contributions']);
        return view('repEnd.planDetails', compact('plan'));
    }

    public function makeContribution(Request $request, ContributionPlan $plan) {
        $repId = Auth::guard('rep')->id();
        if ($plan->rep_id !== $repId || $plan->status !== 'active') abort(403, 'Unauthorized action.');
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'description' => 'nullable|string',
        ]);
        // Only allow one contribution per day
        $today = now()->format('Y-m-d');
        $exists = $plan->contributions()->whereDate('contributed_on', $today)->exists();
        if ($exists) {
            return redirect()->back()->with('error', 'Contribution for today already exists.');
        }
        Contribution::create([
            'plan_id' => $plan->id,
            'amount' => $request->amount,
            'contributed_on' => $today,
            'description' => $request->description,
        ]);
        // update wallet table
        $user = $plan->user;
        $user->wallet_balance += $request->amount;
        $user->save();
        // update transaction table
        Transaction::create([
            'user_id' => $user->id,
            'rep_id' => $repId,
            'plan_id' => $plan->id,
            'wallet_type' => 'user',
            'type' => 'credit',
            'amount' => $request->amount,
            'description' => $request->description ?: 'Contribution for plan: '.$plan->title,
        ]);
        // Optionally update plan status if completed
        if ($plan->contributions()->count() >= $plan->duration) {
            $plan->status = 'completed';
            $plan->save();
        }
        return redirect()->route('rep.planDetails', ['plan' => $plan->id])->with('success', 'Contribution made successfully.');
    }

    public function revisitContribution(Request $request, ContributionPlan $plan) {
        $repId = Auth::guard('rep')->id();
        if ($plan->rep_id !== $repId || $plan->status !== 'active') abort(403, 'Unauthorized action.');
        $request->validate([
            'contributed_on' => 'required|array',
            'contributed_on.*' => 'required|date',
            'amount' => 'required|numeric|min:1',
            'description' => 'nullable|string',
        ]);
        
        $start = $plan->start_date ? \Carbon\Carbon::parse($plan->start_date) : null;
        $end = $start ? $start->copy()->addDays($plan->duration - 1) : null;
        $user = $plan->user;
        $totalAmount = 0;
        $successCount = 0;
        $errors = [];
        
        // Loop through each selected date
        foreach ($request->contributed_on as $dateString) {
            $date = \Carbon\Carbon::parse($dateString);
            
            // Validate date is within plan range
            if (!$start || $date->lt($start) || $date->gt($end)) {
                $errors[] = "Invalid date {$dateString} for this plan.";
                continue;
            }
            
            // Check if contribution already exists for this date
            $exists = $plan->contributions()->whereDate('contributed_on', $date->format('Y-m-d'))->exists();
            if ($exists) {
                $errors[] = "Contribution for {$dateString} already exists.";
                continue;
            }
            
            // Create contribution
            Contribution::create([
                'plan_id' => $plan->id,
                'amount' => $request->amount,
                'contributed_on' => $date->format('Y-m-d'),
                'description' => $request->description,
            ]);
            
            $totalAmount += $request->amount;
            $successCount++;
        }
        
        // Update wallet and create transaction if any contributions were successful
        if ($successCount > 0) {
            $user->wallet_balance += $totalAmount;
            $user->save();
            
            // Create transaction record
            Transaction::create([
                'user_id' => $user->id,
                'rep_id' => $repId,
                'plan_id' => $plan->id,
                'wallet_type' => 'user',
                'type' => 'credit',
                'amount' => $totalAmount,
                'description' => $request->description ?: "Multiple contributions for plan: {$plan->title}",
            ]);
            
            // Check if plan is completed
            if ($plan->contributions()->count() >= $plan->duration) {
                $plan->status = 'completed';
                $plan->save();
            }
        }
        
        // Prepare response message
        if ($successCount > 0 && empty($errors)) {
            $message = $successCount === 1 ? 
                'Skipped day contribution added successfully.' : 
                "Successfully added {$successCount} contributions.";
            return redirect()->route('rep.planDetails', ['plan' => $plan->id])->with('success', $message);
        } elseif ($successCount > 0 && !empty($errors)) {
            $message = "Successfully added {$successCount} contributions. " . implode(' ', $errors);
            return redirect()->route('rep.planDetails', ['plan' => $plan->id])->with('warning', $message);
        } else {
            return redirect()->back()->with('error', implode(' ', $errors));
        }
    }

}
