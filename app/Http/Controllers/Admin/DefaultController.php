<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\User;
use App\Models\Rep;
use App\Models\Wallet;
use App\Models\Manager;
use App\Models\Withdrawal;
use App\Models\Manualfund;
use App\Models\Transaction;
use App\Models\AdminWallet;
use Illuminate\Http\Request;
use App\Models\pendTransactions;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DefaultController extends Controller
{
    

    public function __construct()
    {
      //  $adminDetails = Auth::user('admin');
    }

    public function index(){
        // System-wide statistics
        $totalUsers = User::count();
        $totalReps = Rep::count();
        $totalPlans = \App\Models\ContributionPlan::count();
        $totalTransactions = Transaction::count();
        $totalWallet = User::sum('wallet_balance');
        
        // Active vs inactive counts
        $activeUsers = User::where('status', 'active')->count();
        $inactiveUsers = User::where('status', 'inactive')->count();
        $activeReps = Rep::where('status', 'active')->count();
        $inactiveReps = Rep::where('status', 'inactive')->count();
        
        // Plan statistics
        $activePlans = \App\Models\ContributionPlan::where('status', 'active')->count();
        $completedPlans = \App\Models\ContributionPlan::where('status', 'completed')->count();
        $brokenPlans = \App\Models\ContributionPlan::where('status', 'broken')->count();
        
        // Transaction statistics
        $totalCredits = Transaction::where('type', 'credit')->sum('amount');
        $totalDebits = Transaction::where('type', 'debit')->sum('amount');
        $netFlow = $totalCredits - $totalDebits;
        
        // Admin wallet balance
        $adminWallet = AdminWallet::where('org_id', current_org_id())->first();
        $adminWalletBalance = $adminWallet ? $adminWallet->amount : 0;
        
        // Top performing reps
        $topReps = Rep::withCount('users')
            ->addSelect([
                'users_sum_wallet_balance' => \App\Models\User::selectRaw('COALESCE(SUM(wallet_balance),0)')
                    ->whereColumn('rep_id', 'reps.id')
                    ->where('org_id', current_org_id())
            ])
            ->orderByDesc('users_count')
            ->orderByDesc('users_sum_wallet_balance')
            ->limit(5)
            ->get();
        
        // Recent activities
        $recentTransactions = Transaction::with(['user', 'rep'])
            ->orderBy('created_at', 'DESC')
            ->limit(10)
            ->get();
        
        $recentPlans = \App\Models\ContributionPlan::with(['user', 'rep'])
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->get();
        
        $recentUsers = User::with('rep')
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->get();
        
        // Monthly statistics (last 6 months)
        $monthlyStats = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthlyStats[] = [
                'month' => $date->format('M Y'),
                'users' => User::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)->count(),
                'transactions' => Transaction::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)->count(),
                'plans' => \App\Models\ContributionPlan::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)->count(),
            ];
        }
        
        // Contribution statistics
        $totalContributions = \App\Models\Contribution::sum('amount');
        $avgContribution = \App\Models\Contribution::avg('amount');
        
        return view('adminend.dashboard', [
            'totalUsers' => $totalUsers,
            'totalReps' => $totalReps,
            'totalPlans' => $totalPlans,
            'totalTransactions' => $totalTransactions,
            'totalWallet' => $totalWallet,
            'activeUsers' => $activeUsers,
            'inactiveUsers' => $inactiveUsers,
            'activeReps' => $activeReps,
            'inactiveReps' => $inactiveReps,
            'activePlans' => $activePlans,
            'completedPlans' => $completedPlans,
            'brokenPlans' => $brokenPlans,
            'totalCredits' => $totalCredits,
            'totalDebits' => $totalDebits,
            'netFlow' => $netFlow,
            'adminWalletBalance' => $adminWalletBalance,
            'topReps' => $topReps,
            'recentTransactions' => $recentTransactions,
            'recentPlans' => $recentPlans,
            'recentUsers' => $recentUsers,
            'monthlyStats' => $monthlyStats,
            'totalContributions' => $totalContributions,
            'avgContribution' => $avgContribution
        ]);
    }
    
  public function sendMessage(){

     return view('adminend.sendMessage');

    }
    
     public function psendMessage(Request $req){
         
         if($req->accNum == null){
             return redirect()->back()->with('error','Account Number reuqired');
         }else{
            $user = User::where('accNum',$req->accNum)->first();
             if($user == null){
           return redirect()->back()->with('error','Invalid Account Number');
             }else{
                 $num = $user->phoneNumber;
                 $message = $req->message;
                 $this->sendnotif($req->accNum,$num,$message);
          return redirect()->back()->with('success','Message Successfully Sent');
             }
         }

     return view('adminend.sendMessage');

    }
    
    
      public function testSms(){

     return view('adminend.testSms');

    }
    
     public function ptestSms(Request $req){

$username = 'bensomed';
$password = 'Febr1991/bulksms4';
$messages = array(
  array('to'=>'+2349038472927', 'body'=>'Hello dev afo!'),
  array('to'=>'+2348166035923', 'body'=>'it is working fine,testing bulk sms!')
);  

$result = $this->send_message( json_encode($messages), 'https://api.bulksms.com/v1/messages?auto-unicode=true&longMessageMaxParts=30', $username, $password );

if ($result['http_status'] != 201) {
  print "Error sending: " . ($result['error'] ? $result['error'] : "HTTP status ".$result['http_status']."; Response was " .$result['server_response']);
} else {
  print "Response " . $result['server_response'];
  // Use json_decode($result['server_response']) to work with the response further
}


     }
     
   private function send_message ( $post_body, $url, $username, $password) {
    
  $ch = curl_init( );
  $headers = array(
  'Content-Type:application/json',
  'Authorization:Basic '. base64_encode("$username:$password")
  );
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt ( $ch, CURLOPT_URL, $url );
  curl_setopt ( $ch, CURLOPT_POST, 1 );
  curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
  curl_setopt ( $ch, CURLOPT_POSTFIELDS, $post_body );
  // Allow cUrl functions 20 seconds to execute
  curl_setopt ( $ch, CURLOPT_TIMEOUT, 20 );
  // Wait 10 seconds while trying to connect
  curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 10 );
  $output = array();
  $output['server_response'] = curl_exec( $ch );
  $curl_info = curl_getinfo( $ch );
  $output['http_status'] = $curl_info[ 'http_code' ];
  $output['error'] = curl_error($ch);
  curl_close( $ch );
  return $output;

    
   }
    
    
    private function sendnotif($accNum,$num,$message){

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
    
   // users
   
    public function users(){

      $users = User::all();
      return view('adminend.users',['title'=>'Users','users'=>$users]);
    }
    
     public function editUser(User $user){

      return view('adminend.editUser',['title'=>'Edit User','userDetails'=>$user,'reps'=>Rep::all() ]);

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

        if( ($userID->referral) !== null ){
               if( ($userID->rep) !== null){
                 $repNumb = $userID->rep->phoneNumber;
                 $repName = $userID->rep->name;
                 $this->updateRepsms($name,$request->accNum,$repName,$repNumb);
               }
        }

     }

      $userID->update($request->except(['org_id', 'wallet_balance', 'password', 'is_lock']));
  return redirect(route('admin.users'))->with('success',$message);

}

     public function lockUser(Request $request){
          
          $user = User::find($request->user_id);
          
             if($user->is_lock){
                 $mssg = $user->firstName."'s"." account has been unlocked";
             }else{
                $mssg = $user->firstName."'s"." account has been locked";
             }
             
            $user->is_lock = $user->is_lock ? 0 : 1;
            $updater = $user->save();
          if(  $updater ){
          return redirect(route('admin.users'))->with('success',$mssg);
        }else{
          return redirect(route('admin.users'))->with('error','Something went wrong,please try again');
    
        }
    
       }


        private function updateUsersms($name,$accNum,$num){
                $message = "Dear ".$name."\n Welcome on board with us.Your SMYL account number is ".$accNum."\n.Kindly meet any of our agents around you to drop your authentic details.";
        
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
        
        public function changeUserPassword(User $user){

      return view('adminend.changeUserPassword',['title'=>'Change User Password','userDetails'=>$user]);

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
             return redirect(route('admin.users') )->with('success', $mssg);
           }else{
             return redirect(route('admin.users') )->with('error', 'Something went wrong,please try again');
           }
    }
    
    // REPS

   public function reps(){

      $reps = Rep::withCount('users')->get();
      return view('adminend.reps',['title'=>'Reps','reps'=>$reps]);
    }
    
    public function repDetails(Rep $rep){
        $users = $rep->users;
        $contributionPlans = $rep->contributionPlans;
        $transactions = Transaction::where('rep_id', $rep->id)->orderBy('created_at', 'DESC')->get();

        // Calculate Metrics
        $today = now()->startOfDay();
        $thisWeek = now()->startOfWeek();
        $thisMonth = now()->startOfMonth();

        $dailyEarnings = Transaction::where('rep_id', $rep->id)
            ->where('type', 'credit')
            ->where('created_at', '>=', $today)
            ->sum('amount');

        $weeklyEarnings = Transaction::where('rep_id', $rep->id)
            ->where('type', 'credit')
            ->where('created_at', '>=', $thisWeek)
            ->sum('amount');

        $monthlyEarnings = Transaction::where('rep_id', $rep->id)
            ->where('type', 'credit')
            ->where('created_at', '>=', $thisMonth)
            ->sum('amount');

        // Plan status counts
        $activePlansCount = $contributionPlans->where('status', 'active')->count();
        $completedPlansCount = $contributionPlans->where('status', 'completed')->count();
        $brokenPlansCount = $contributionPlans->where('status', 'broken')->count();

        // Multi-timeframe performance data
        
        // 1. Daily (Last 30 days)
        $dailyPerformance = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $revenue = Transaction::where('rep_id', $rep->id)
                ->where('type', 'credit')
                ->whereDate('created_at', $date->toDateString())
                ->sum('amount');
            $dailyPerformance[] = ['label' => $date->format('d M'), 'value' => $revenue];
        }

        // 2. Weekly (Last 8 weeks)
        $weeklyPerformance = [];
        for ($i = 7; $i >= 0; $i--) {
            $start = now()->subWeeks($i)->startOfWeek();
            $end = now()->subWeeks($i)->endOfWeek();
            $revenue = Transaction::where('rep_id', $rep->id)
                ->where('type', 'credit')
                ->whereBetween('created_at', [$start, $end])
                ->sum('amount');
            $weeklyPerformance[] = ['label' => 'Week ' . $start->format('W'), 'value' => $revenue];
        }

        // 3. Monthly (Last 12 months)
        $monthlyPerformance = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $revenue = Transaction::where('rep_id', $rep->id)
                ->where('type', 'credit')
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->sum('amount');
            $monthlyPerformance[] = ['label' => $month->format('M Y'), 'value' => $revenue];
        }

        // 4. Yearly (Last 5 years)
        $yearlyPerformance = [];
        for ($i = 4; $i >= 0; $i--) {
            $year = now()->subYears($i)->year;
            $revenue = Transaction::where('rep_id', $rep->id)
                ->where('type', 'credit')
                ->whereYear('created_at', $year)
                ->sum('amount');
            $yearlyPerformance[] = ['label' => (string)$year, 'value' => $revenue];
        }

        return view('adminend.repDetails', [
            'title' => 'Rep Details',
            'rep' => $rep,
            'users' => $users,
            'contributionPlans' => $contributionPlans,
            'transactions' => $transactions,
            'metrics' => [
                'daily_earnings' => $dailyEarnings,
                'weekly_earnings' => $weeklyEarnings,
                'monthly_earnings' => $monthlyEarnings,
                'active_plans' => $activePlansCount,
                'completed_plans' => $completedPlansCount,
                'broken_plans' => $brokenPlansCount,
                'total_revenue' => $transactions->where('type', 'credit')->sum('amount')
            ],
            'chartData' => [
                'daily' => [
                    'labels' => array_column($dailyPerformance, 'label'),
                    'data' => array_column($dailyPerformance, 'value')
                ],
                'weekly' => [
                    'labels' => array_column($weeklyPerformance, 'label'),
                    'data' => array_column($weeklyPerformance, 'value')
                ],
                'monthly' => [
                    'labels' => array_column($monthlyPerformance, 'label'),
                    'data' => array_column($monthlyPerformance, 'value')
                ],
                'yearly' => [
                    'labels' => array_column($yearlyPerformance, 'label'),
                    'data' => array_column($yearlyPerformance, 'value')
                ]
            ]
        ]);
    }
    
    public function addRep(){

      return view('adminend.createRep',['title'=>'Create Rep']);
    }

    public function searchUsers(Request $request){
        $query = $request->get('q', '');
        
        if(empty($query)){
            return response()->json([]);
        }
        
        $users = User::where(function ($q) use ($query) {
                        $q->where('name', 'LIKE', "%{$query}%")
                            ->orWhere('email', 'LIKE', "%{$query}%")
                            ->orWhere('username', 'LIKE', "%{$query}%")
                            ->orWhere('phone', 'LIKE', "%{$query}%");
                    })
                    ->limit(5)
                    ->get(['id', 'name', 'email', 'username', 'phone']);
        
        return response()->json($users);
    }

    public function createRep(Request $request){

      $request->validate([
        'name' => ['required', 'string','max:255'],
        'username' => ['required','string','unique:reps','max:255'],
        'email' => ['required','email','unique:reps','max:255'],
        'phone' => ['required','string','max:255'],
        'password' => ['required', 'string', 'min:4', 'confirmed'],
      ]);

      $creator = Rep::create([
        'name' => $request->name,
        'email'=> $request->email,
        'phone' => $request->phone,
        'username' => $request->username,
        'password' => Hash::make($request->password),
        'status' => 'active',
        'wallet_balance' => 0.00,
      ]);

      if($creator){
          return redirect(route('admin.reps'))->with('success','New Rep Created');
      }else{
        return redirect()->back()->with('error','Something Went Wrong');
      }

    }
    
    
     public function editRep(Rep $rep){

      return view('adminend.editRep',['title'=>'Edit Rep','repDetails'=>$rep]);

    }

    public function updateRepProfile(Request $request,Rep $repID){

        $mssg = $request->name."'s"." profile has been updated";
      $data = $request->except(['org_id', 'wallet_balance', 'password', 'password_confirmation', 'is_lock']);
      if ($request->filled('password')) {
          $data['password'] = Hash::make($request->password);
      }
      if(  $repID->update($data) ){
      return redirect(route('admin.reps'))->with('success',$mssg);
    }else{
      return redirect(route('admin.reps'))->with('error','Something went wrong,please try again');

    }

}



  public function lockrep(Request $request){
      
      $rep = Rep::find($request->rep_id);
      
         if($rep->status === 'active'){
             $mssg = $rep->name."'s"." account has been locked";
             $rep->status = 'inactive';
         }else{
            $mssg = $rep->name."'s"." account has been unlocked";
            $rep->status = 'active';
         }
         
        $updater = $rep->save();
      if(  $updater ){
      return redirect(route('admin.reps'))->with('success',$mssg);
    }else{
      return redirect(route('admin.reps'))->with('error','Something went wrong,please try again');

    }

   }

    public function changeRepPassword(Rep $rep){

      return view('adminend.changeRepPassword',['title'=>'Change Rep Password','repDetails'=>$rep]);

    }
    
        public function updateRepPassword(Request $request,Rep $repID){

            $request->validate([
              'password' => ['required', 'string', 'min:4', 'confirmed'],
            ]);

            $name = $repID->name;
            $mssg = $name."'s"." password has been changed";

            $repID->password = Hash::make($request->password);

           $updateRepPassword = $repID->save();

           if($updateRepPassword){
             return redirect(route('admin.reps') )->with('success', $mssg);
           }else{
             return redirect(route('admin.reps') )->with('error', 'Something went wrong,please try again');
           }
    }
    
    private function updateRepsms($name,$accNum,$repName,$repNumb){
        $message = "Dear ".$repName.",\n You have a new customer,\n".$name." of account number:\n".$accNum.".\n Kindly monitor his/her subsequent transactions.\n Thanks.";

      $request = "";
      $param["api_token"] = "k3JXHTyCXv7utY4WJavoI0C4r830luhKmyi5U1E4tFVBpO0xi8X8Eobhh0fK";
      $param["from"] = "SMYL";
      $param["to"] =  $repNumb;
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


 
    // MANAGERS
    
     public function managers(){

      $managers = Manager::all();
      return view('adminend.managers',['title'=>'Managers','managers'=>$managers]);
    }
    
    
      public function addManager(){

      return view('adminend.createManager',['title'=>'Create Manager']);
    }

    public function createManager(Request $request){

      $request->validate([
        'name' => ['required', 'string','max:255'],
        'username' => ['required','string','unique:managers','max:255'],
        'email' => ['required','string','unique:managers','max:255'],
        'password' => ['required', 'string', 'min:4', 'confirmed'],
      ]);

      $creator = Manager::create([
        'name' => $request->name,
        'email'=> $request->email,
        'role' => "manager",
        'username' => $request->username,
        'password' => Hash::make($request->password),
      ]);

      if($creator){
          return redirect(route('admin.managers'))->with('success','New Manager  Successfully Created');
      }else{
        return redirect(route('admin.addManager'))->with('error','Something Went Wrong');
      }

    }
    
    
    public function editManager(Manager $manager){

      return view('adminend.editManager',['title'=>'Edit Manager','managerDetails'=>$manager]);

    }

    public function updateManagerProfile(Request $request,Manager $managerID){

        $mssg = $request->name."'s"." profile has been updated";
      $data = $request->except(['org_id', 'wallet_balance', 'password', 'password_confirmation', 'is_lock']);
      if ($request->filled('password')) {
          $data['password'] = Hash::make($request->password);
      }
      if(  $managerID->update($data) ){
      return redirect(route('admin.managers'))->with('success',$mssg);
    }else{
      return redirect(route('admin.managers'))->with('error','Something went wrong,please try again');

    }

}


    public function changeManagerPassword(Manager $manager){

      return view('adminend.changeRepPassword',['title'=>'Change Manager Password','managerDetails'=>$manager]);

    }
    
        public function updateManagerPassword(Request $request,Manager $managerID){

            $request->validate([
              'password' => ['required', 'confirmed'],
            ]);

            $name = $managerID->name;
            $mssg = $name."'s"." password has been changed";

            $managerID->password = Hash::make($request->password);

           $updateManagerPassword = $managerID->save();

           if($updateManagerPassword){
             return redirect(route('admin.managers') )->with('success', $mssg);
           }else{
             return redirect(route('admin.managers') )->with('error', 'Something went wrong,please try again');
           }
    }
    
    

// admin

    public function profile(){
        $totalUsers = User::count();
        $totalReps = Rep::count();
        $totalPlans = \App\Models\ContributionPlan::where('status', 'active')->count();
        $recentTransactions = Transaction::with('user')->orderBy('created_at', 'DESC')->limit(10)->get();
        
        return view('adminend.profile',[
            'title'=>'Profile',
            'totalUsers' => $totalUsers,
            'totalReps' => $totalReps,
            'totalPlans' => $totalPlans,
            'recentTransactions' => $recentTransactions
        ]);
    }

    public function editProfile(Admin $admin){

      return view('adminend.editProfile',['adminDetails'=> $admin,'title'=>'Update Profile']);

    }

    public function updateProfile(Request $request,Admin $adminID){

        $adminID->update($request->only(['name', 'email', 'username']));
      return redirect(route('admin.profile'))->with('success','Your Profile has been Successfully updated');

}

    public function transactions(){
        $transactions = Transaction::with(['user', 'rep'])->orderBy('created_at', 'DESC')->get();
        return view('adminend.transactions',['transactions' => $transactions,'title' => 'transactions']);
    }
    
     public function userTransaction(Request $req){

            // $transactions = Transaction::all();
            $transactions = Transaction::where('user_id',$req->uid)->orderBy('id', 'DESC')->get();
            return view('adminend.transactions',['transactions' => $transactions,'title' => 'transactions']);
    }

    public function usersWallet(){
        $users = User::with(['rep', 'contributionPlans', 'transactions'])->get();
        return view('adminend.usersWallet',['users' => $users,'title' => 'Wallets']);
    }

    public function adminWallet(){
        // Get admin wallet
        $adminWallet = AdminWallet::where('org_id', current_org_id())->first();
        $adminWalletBalance = $adminWallet ? $adminWallet->amount : 0;
        
        // Get admin transactions
        $adminTransactions = Transaction::where('wallet_type', 'business')
            ->with(['rep', 'plan'])
            ->orderBy('created_at', 'DESC')
            ->get();
        
        return view('adminend.adminWallet', [
            'adminWalletBalance' => $adminWalletBalance,
            'adminTransactions' => $adminTransactions,
            'title' => 'Admin Wallet'
        ]);
    }


    public function DebitOrCreditUser($transType,User $userID){

            return view('adminend.creditorDebitUser',['transType' => $transType,'user'=>$userID,'title' => $transType]);

    }
    
        public function Ptransactions(){

            $Ptransactions = pendTransactions::orderBy('id', 'DESC')->get();
            return view('adminend.Ptransactions',['Ptransactions' => $Ptransactions,'title' => 'Pending Credits']);
    }
    
            public function PUsertransactions($userID){
            $user = User::find($userID);

            if (!$user) {
                abort(404);
            }

            $Ptransactions = pendTransactions::where('user_id', $user->id)->get();
            return view('adminend.PUsertransactions',['Ptransactions' => $Ptransactions,'title' => 'Pending User Credits','userID'=>$userID]);
    }
    
    
            public function RepPtransactions($repID){
                
                $usersIDs = Rep::find($repID)->user()->pluck('id')->toArray();
                
            $Ptransactions = pendTransactions::whereIn('user_id',$usersIDs)->orderBy('created_at', 'DESC')->get();

            // $Ptransactions = pendTransactions::orderBy('id', 'DESC')->get();
            return view('adminend.Ptransactions',['Ptransactions' => $Ptransactions,'title' => 'Pending Credits']);
    }
    
        public function approveCredit(pendTransactions $transID){
        $userID = User::find($transID->user_id);
      $rtnMesssage = $this->creditUser($userID,$transID->amount);
      if($rtnMesssage){
        $transID->delete();
      return redirect(route('admin.Ptransactions'))->with('success',$rtnMesssage);
    }else{
      return redirect(route('admin.Ptransactions'))->with('error',"Something went wrong,please try again");
    }

     }
     
       public function disApproveCredit(pendTransactions $transID){
      $rtnMesssage = $transID->delete();
      if($rtnMesssage){
      return redirect(route('admin.Ptransactions'))->with('success','Pending Credit,Successfully Deleted');
    }else{
      return redirect(route('admin.Ptransactions'))->with('error',"Something went wrong,please try again");
    }

     }
     
     
     
      public function approveAllCredits(){
          
          $transactions = pendTransactions::all();
          
          foreach($transactions as $trans){
         $userID = User::find($trans->user_id);
           $rtnMesssage = $this->creditUser($userID,$trans->amount);
        $trans->delete();
          }
   
      return redirect(route('admin.Ptransactions'))->with('success','All Transactions Successfully Updated');

     }
     
     public function approveAllUserCredits($userID){
          
          $transactions = pendTransactions::where('user_id',$userID)->get();
          
          foreach($transactions as $trans){
         $userID = User::find($trans->user_id);
           $rtnMesssage = $this->creditUser($userID,$trans->amount);
        $trans->delete();
          }
   
      return redirect(route('admin.Ptransactions'))->with('success','All Transactions Successfully Updated');

     }


    public function updateUserWallet($transType,User $userID,Request $request){

          if($transType == "credit"){
            $rtnMesssage = $this->creditUser($userID,$request->amount,$request->narration);
            return redirect(route('admin.usersWallet'))->with('success',$rtnMesssage);
          }else{

            $rtnMesssage = $this->debitUser($userID,$request->amount,$request->narration);
            return redirect(route('admin.usersWallet'))->with('success',$rtnMesssage);


          }

    }

    private function debitUser($userID,$amount,$narration ="NULL"){
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

     $this->saveTransaction($about,$transType,$user_id,$amount,$refKey,$narration);

     $rtnMesssage = $userID->firstName.' '.$userID->lastName."'s"." account has been debited"." ".$amount;
     return $rtnMesssage;
    }

    private function creditUser($userID,$amount,$narration="NULL"){

       $userWallet = $userID::find($userID->id)->wallet;
         if($userWallet !== null){
          $oldAmount =  $userWallet->amount;
          $newAmount = $amount + $oldAmount;
         }else{
      $newAmount = $amount;
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

     $this->saveTransaction($about,$transType,$user_id,$amount,$refKey,$narration);

     $rtnMesssage = $userID->firstName.' '.$userID->lastName."'s"." account has been credited"." ".$amount;
     return $rtnMesssage;
     
    }


    private function saveTransaction($about,$transType,$user_id,$amount,$refKey,$narration){
      $user_id = User::find($user_id);
      $accNum = $user_id->accNum;
      $splitACC = (substr($accNum, 3, 9));
      $acc = "***".$splitACC;
      $bal = User::find($user_id->id)->wallet->amount;
      $num =  $user_id->phoneNumber;
      $this->sendSMS($transType,$acc,$amount,$bal,$num,$narration);
       return Transaction::create([
       'about' => $about,
       'transType' => $transType,
       'user_id' => $user_id->id,
       'amount' => $amount,
        'narration' => $narration??'null',
       'refKey' => $refKey
       ]);
    }

    private function sendSMS($transType,$acc,$amount,$bal,$num,$narration){
        date_default_timezone_set('Africa/Lagos');
       $time = date("d/m/Y h:i A");
       if($narration == "NULL"){
        $message = ucfirst($transType)."\nAcc: ".$acc."\nAmt: NGN".number_format($amount)."\nTime: ".$time."\nTotal Bal: NGN".number_format($bal);
       }else{
          $message = ucfirst($transType)."\nAcc: ".$acc."\nAmt: NGN".number_format($amount)."\nNar: ".$narration."\nTime: ".$time."\nTotal Bal: NGN".number_format($bal);  
       }
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
      $collection = pendTransactions::where('user_id', $user->id)->get(['id']);
      
     pendTransactions::destroy($collection->toArray()); 
        
      $user->delete();
    return redirect(route('admin.users') )->with('error', 'User Account has been deleted');
   }

   public function deleteRep( Rep $rep
       )
       {
       $rep->delete();
       return redirect(route('admin.reps') )->with('error', 'Rep Account has been deleted');
      }
      
        public function deleteManager( Manager $manager
       )
       {
       $manager->delete();
       return redirect(route('admin.managers') )->with('error', 'Manager Account has been deleted');
      }

    // PLANS
    public function plans(Request $request){
        $query = \App\Models\ContributionPlan::with(['user', 'rep', 'contributions']);
        
        // Filter by status if provided
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        
        $plans = $query->orderBy('created_at', 'DESC')->get();
        
        // Group plans by user
        $groupedPlans = $plans->groupBy('user_id');
        
        // Get users with their plan counts and status summary
        $usersWithPlans = User::where('status', 'active')
            ->get()
            ->map(function($user) use ($groupedPlans) {
                $userPlans = $groupedPlans->get($user->id, collect());
                $activePlans = $userPlans->where('status', 'active')->count();
                $completedPlans = $userPlans->where('status', 'completed')->count();
                $brokenPlans = $userPlans->where('status', 'broken')->count();
                $totalAmount = $userPlans->sum('amount');
                $totalContributed = $userPlans->sum(function($plan) {
                    return $plan->contributions->sum('amount');
                });
                
                return [
                    'user' => $user,
                    'plans' => $userPlans,
                    'plan_counts' => [
                        'total' => $userPlans->count(),
                        'active' => $activePlans,
                        'completed' => $completedPlans,
                        'broken' => $brokenPlans
                    ],
                    'total_amount' => $totalAmount,
                    'total_contributed' => $totalContributed
                ];
            })
            ->filter(function($userData) {
                // Only show users who have plans
                return $userData['plan_counts']['total'] > 0;
            })
            ->sortByDesc('plan_counts.total');
        
        return view('adminend.plans', [
            'title' => 'Contribution Plans', 
            'usersWithPlans' => $usersWithPlans,
            'plans' => $plans, // Keep for statistics
            'currentFilter' => $request->status
        ]);
    }

    public function planDetails($plan){
        $plan = \App\Models\ContributionPlan::findOrFail($plan);
        $plan->load(['rep', 'contributions']);
        return view('adminend.planDetails', ['title' => 'Plan Details', 'plan' => $plan]);
    }

    public function breakPlan($planId){
        $plan = \App\Models\ContributionPlan::find($planId);
        if($plan){
            try {
                DB::beginTransaction();
                
                $dailyContribution = $plan->amount;
                $user = $plan->user;
                $totalContributions = $plan->contributions()->sum('amount');
                $remainingAmount = $totalContributions - $dailyContribution;
                
                $user->wallet_balance -= $totalContributions;
                $user->save();
                
                $adminWallet = $this->orgAdminWallet();
                
                $adminWallet->amount += $dailyContribution;
                $adminWallet->save();
                
                if($remainingAmount > 0) {
                    $userWallet = Wallet::firstOrCreate(
                        ['user_id' => $user->id],
                        ['amount' => 0]
                    );
               
                    $userWallet->amount += $remainingAmount;
                    $userWallet->save();
                }
                
                Transaction::create([
                    'user_id' => $user->id,
                    'rep_id' => $plan->rep_id,
                    'plan_id' => $plan->id,
                    'wallet_type' => 'user',
                    'type' => 'debit',
                    'amount' => $dailyContribution,
                    'description' => 'Plan break - one day contribution deducted for plan: ' . $plan->title,
                ]);
                
                Transaction::create([
                    'user_id' => $user->id,
                    'rep_id' => $plan->rep_id,
                    'plan_id' => $plan->id,
                    'wallet_type' => 'business',
                    'type' => 'credit',
                    'amount' => $dailyContribution,
                    'description' => 'Plan break - one day contribution received for plan: ' . $plan->title.' moved to admin wallet',
                ]);
                
                if($remainingAmount > 0) {
                    Transaction::create([
                        'user_id' => $user->id,
                        'rep_id' => $plan->rep_id,
                        'plan_id' => $plan->id,
                        'wallet_type' => 'user',
                        'type' => 'credit',
                        'amount' => $remainingAmount,
                        'description' => 'Plan break - remaining contributions returned for plan: ' . $plan->title.' moved to user wallet',
                    ]);
                }
                
                $plan->status = 'broken';
                $plan->save();
                
                DB::commit();
                
                $message = 'Plan has been broken successfully. ';
                $message .= 'One day contribution (₦' . number_format($dailyContribution, 2) . ') transferred to admin wallet. ';
                if($remainingAmount > 0) {
                    $message .= 'Remaining amount (₦' . number_format($remainingAmount, 2) . ') credited to user wallet.';
                } else {
                    $message .= 'No remaining amount to refund.';
                }
                
                return redirect()->back()->with('success', $message);
                
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', 'An error occurred while breaking the plan. All changes have been rolled back.');
            }
        }
        return redirect()->back()->with('error', 'Plan not found');
    }

    public function completePlan($planId){
        $plan = \App\Models\ContributionPlan::find($planId);
        if($plan){
            try {
                DB::beginTransaction();
                
                $dailyContribution = $plan->amount;
                $user = $plan->user;
                $totalContributions = $plan->contributions()->sum('amount');
                $remainingAmount = $totalContributions - $dailyContribution;
                
                $user->wallet_balance -= $totalContributions;
                $user->save();
                
                $adminWallet = $this->orgAdminWallet();
                
                $adminWallet->amount += $dailyContribution;
                $adminWallet->save();
                
                if($remainingAmount > 0) {
                    $userWallet = Wallet::firstOrCreate(
                        ['user_id' => $user->id],
                        ['amount' => 0]
                    );
               
                    $userWallet->amount += $remainingAmount;
                    $userWallet->save();
                }
                
                Transaction::create([
                    'user_id' => $user->id,
                    'rep_id' => $plan->rep_id,
                    'plan_id' => $plan->id,
                    'wallet_type' => 'user',
                    'type' => 'debit',
                    'amount' => $dailyContribution,
                    'description' => 'Plan complete - one day contribution deducted for plan: ' . $plan->title,
                ]);
                
                Transaction::create([
                    'user_id' => $user->id,
                    'rep_id' => $plan->rep_id,
                    'plan_id' => $plan->id,
                    'wallet_type' => 'business',
                    'type' => 'credit',
                    'amount' => $dailyContribution,
                    'description' => 'Plan complete - one day contribution received for plan: ' . $plan->title.' moved to admin wallet',
                ]);
                
                if($remainingAmount > 0) {
                    Transaction::create([
                        'user_id' => $user->id,
                        'rep_id' => $plan->rep_id,
                        'plan_id' => $plan->id,
                        'wallet_type' => 'user',
                        'type' => 'credit',
                        'amount' => $remainingAmount,
                        'description' => 'Plan complete - remaining contributions returned for plan: ' . $plan->title.' moved to user wallet',
                    ]);
                }
                
                $plan->status = 'completed';
                $plan->save();
                
                DB::commit();
                
                $message = 'Plan has been completed successfully. ';
                $message .= 'One day contribution (₦' . number_format($dailyContribution, 2) . ') transferred to admin wallet. ';
                if($remainingAmount > 0) {
                    $message .= 'Remaining amount (₦' . number_format($remainingAmount, 2) . ') credited to user wallet.';
                } else {
                    $message .= 'No remaining amount to refund.';
                }
                
                return redirect()->back()->with('success', $message);
                
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', 'An error occurred while completing the plan. All changes have been rolled back.');
            }
        }
        return redirect()->back()->with('error', 'Plan not found');
    }

    // USER DETAILS
    public function userDetails(User $user){
        $contributionPlans = $user->contributionPlans()->with('contributions')->get();
        $transactions = $user->transactions()->orderBy('created_at', 'DESC')->get();
        
        return view('adminend.userDetails', [
            'title' => 'User Details',
            'user' => $user,
            'contributionPlans' => $contributionPlans,
            'transactions' => $transactions
        ]);
    }
    
    
    //  WITHDRAWAL REQUEST 
    
    public function withdrawal()
    {
        $withdrawals = Withdrawal::with('user')->latest()->get();
        return view('adminend.withdrawal', compact('withdrawals'));
    }
    
    public function updateWithdrawalStatus(Request $request, Withdrawal $withdrawal)
    {
        $request->validate([
            'status' => 'required|in:pending,ongoing,done,reversed,failed'
        ]);
        
        if (!$withdrawal->canUpdateStatus()) {
            return redirect()->back()->with('error', 'Cannot update status for this withdrawal request.');
        }
        
        $withdrawal->status = $request->status;
        $withdrawal->save();
        
        return redirect()->back()->with('success', 'Withdrawal status updated successfully.');
    }
     
        
    //  MANUAL FUNDING REQUEST 
    
    public function manualfunding()
    {
        $manual_fund_requests = Manualfund::with('user')->latest()->get();
        return view('adminend.Manualfund', compact('manual_fund_requests'));
    }
    
    public function updateManualFundingStatus(Request $request, Manualfund $manualfund)
    {
        $request->validate([
            'status' => 'required|in:pending,ongoing,done,reversed,failed'
        ]);
        
        if (!$manualfund->canUpdateStatus()) {
            return redirect()->back()->with('error', 'Cannot update status for this manual funding request.');
        }
        
        $manualfund->status = $request->status;
        $manualfund->save();
        
        return redirect()->back()->with('success', 'Manual funding status updated successfully.');
    }

    /**
     * Treasury wallet for the organisation currently in context.
     * Ghost mode has no admin guard user, so fall back to that org's admin.
     *
     * @return \App\Models\AdminWallet
     */
    protected function orgAdminWallet()
    {
        $orgId = current_org_id();
        $adminId = Auth::guard('admin')->id();

        if (!$adminId && $orgId) {
            $adminId = Admin::where('org_id', $orgId)->value('id');
        }

        return AdminWallet::firstOrCreate(
            ['org_id' => $orgId],
            ['admin_id' => $adminId, 'amount' => 0]
        );
    }

}
