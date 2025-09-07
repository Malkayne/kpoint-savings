<?php

namespace App\Http\Controllers\Manager;

use App\Models\Admin;
use App\Models\Manager;
use App\Models\Rep;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Transaction;
use App\Models\pendTransactions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DefaultController extends Controller
{

    public function __construct()
    {
      //  $adminDetails = Auth::user('admin');
    }

    public function index(){

     return view('managerend.dashboard');

    }
    
        public function sendMessage(){

     return view('managerend.sendMessage');

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

     return view('managerend.sendMessage');

    }
    
    
      public function testSms(){

     return view('managerend.testSms');

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
    

    public function users(){

      $users = User::all();
      return view('managerend.users',['title'=>'Users','users'=>$users]);
    }

    public function addRep(){

      return view('managerend.createRep',['title'=>'Create Rep']);
    }

    public function searchUsers(Request $request){
        $query = $request->get('q', '');
        
        if(empty($query)){
            return response()->json([]);
        }
        
        $users = User::where('name', 'LIKE', "%{$query}%")
                    ->orWhere('email', 'LIKE', "%{$query}%")
                    ->orWhere('username', 'LIKE', "%{$query}%")
                    ->limit(5)
                    ->get(['id', 'name', 'email', 'username']);
        
        return response()->json($users);
    }

    public function createRep(Request $request){

      $request->validate([
        'name' => ['required', 'string','max:255'],
        'username' => ['required','string','unique:reps','max:255'],
        'phoneNumber' => ['required','unique:reps','string', 'max:255'],
        'password' => ['required', 'string', 'min:4', 'confirmed'],
      ]);

      $creator = Rep::create([
        'name' => $request->name,
        'email'=> $request->email,
        'phoneNumber' => $request->phoneNumber,
        'username' => $request->username,
        'password' => Hash::make($request->password),
      ]);

      if($creator){
          return redirect(route('manager.reps'))->with('success','New Rep Created');
      }else{
        return redirect(route('manager.addRep'))->with('error','Something Went Wrong');
      }

    }

    public function reps(){

      $reps = Rep::all();
      return view('managerend.reps',['title'=>'Reps','reps'=>$reps]);
    }

    public function editUser(User $user){

      return view('managerend.editUser',['title'=>'Edit User','userDetails'=>$user,'reps'=>Rep::all() ]);

    }

    public function editRep(Rep $rep){

      return view('managerend.editRep',['title'=>'Edit Rep','repDetails'=>$rep]);

    }

    public function updateRepProfile(Request $request,Rep $repID){

        $mssg = $request->name."'s"." profile has been updated";
      if(  $repID->update($request->all()) ){
      return redirect(route('manager.reps'))->with('success',$mssg);
    }else{
      return redirect(route('manager.reps'))->with('error','Something went wrong,please try again');

    }

}

    public function changeUserPassword(User $user){

      return view('managerend.changeUserPassword',['title'=>'Change User Password','userDetails'=>$user]);

    }

    public function changeRepPassword(Rep $rep){

      return view('managerend.changeRepPassword',['title'=>'Change Rep Password','repDetails'=>$rep]);

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
             return redirect(route('manager.users') )->with('success', $mssg);
           }else{
             return redirect(route('manager.users') )->with('error', 'Something went wrong,please try again');
           }
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
             return redirect(route('manager.reps') )->with('success', $mssg);
           }else{
             return redirect(route('manager.reps') )->with('error', 'Something went wrong,please try again');
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

        if( ($userID->referral) !== null ){
               if( ($userID->rep) !== null){
                 $repNumb = $userID->rep->phoneNumber;
                 $repName = $userID->rep->name;
                 $this->updateRepsms($name,$request->accNum,$repName,$repNumb);
               }
        }

     }

      $userID->update($request->all());
  return redirect(route('manager.users'))->with('success',$message);

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


    public function profile(){
      return view('managerend.profile',['title'=>'Profile']);
    }

    public function editProfile(Manager $admin){

      return view('managerend.editProfile',['adminDetails'=> $admin,'title'=>'Update Profile']);

    }

    public function updateProfile(Request $request,Manager $adminID){

        $adminID->update($request->all());
      return redirect(route('manager.profile'))->with('success','Your Profile has been Successfully updated');

}

    public function transactions(){

            // $transactions = Transaction::all();
            $transactions = Transaction::orderBy('id', 'DESC')->get();
            return view('managerend.transactions',['transactions' => $transactions,'title' => 'transactions']);
    }
    
    public function userTransaction(Request $req){

            // $transactions = Transaction::all();
            $transactions = Transaction::where('user_id',$req->uid)->orderBy('id', 'DESC')->get();
            return view('managerend.transactions',['transactions' => $transactions,'title' => 'transactions']);
    }

    public function usersWallet(){

            $users = User::all();
            return view('managerend.usersWallet',['users' => $users,'title' => 'Wallets']);
    }


    public function DebitOrCreditUser($transType,User $userID){

            return view('managerend.creditorDebitUser',['transType' => $transType,'user'=>$userID,'title' => $transType]);

    }
    
        public function Ptransactions(){

            $Ptransactions = pendTransactions::orderBy('id', 'DESC')->get();
            return view('managerend.Ptransactions',['Ptransactions' => $Ptransactions,'title' => 'Pending Credits']);
    }
    
            public function PUsertransactions($userID){

            $Ptransactions = pendTransactions::where('user_id',$userID)->get();
            return view('managerend.PUsertransactions',['Ptransactions' => $Ptransactions,'title' => 'Pending User Credits','userID'=>$userID]);
    }
    
    
            public function RepPtransactions($repID){
                
                $usersIDs = Rep::find($repID)->user()->pluck('id')->toArray();
                
            $Ptransactions = pendTransactions::whereIn('user_id',$usersIDs)->orderBy('created_at', 'DESC')->get();

            // $Ptransactions = pendTransactions::orderBy('id', 'DESC')->get();
            return view('managerend.Ptransactions',['Ptransactions' => $Ptransactions,'title' => 'Pending Credits']);
    }
    
        public function approveCredit(pendTransactions $transID){
        $userID = User::find($transID->user_id);
      $rtnMesssage = $this->creditUser($userID,$transID->amount);
      if($rtnMesssage){
        $transID->delete();
      return redirect(route('manager.Ptransactions'))->with('success',$rtnMesssage);
    }else{
      return redirect(route('manager.Ptransactions'))->with('error',"Something went wrong,please try again");
    }

     }
     
       public function disApproveCredit(pendTransactions $transID){
      $rtnMesssage = $transID->delete();
      if($rtnMesssage){
      return redirect(route('manager.Ptransactions'))->with('success','Pending Credit,Successfully Deleted');
    }else{
      return redirect(route('manager.Ptransactions'))->with('error',"Something went wrong,please try again");
    }

     }
     
     
     
      public function approveAllCredits(){
          
          $transactions = pendTransactions::all()->get();
          
          foreach($transactions as $trans){
         $userID = User::find($trans->user_id);
           $rtnMesssage = $this->creditUser($userID,$trans->amount);
        $trans->delete();
          }
   
      return redirect(route('manager.Ptransactions'))->with('success','All Transactions Successfully Updated');

     }
     
     public function approveAllUserCredits($userID){
          
          $transactions = pendTransactions::where('user_id',$userID)->get();
          
          foreach($transactions as $trans){
         $userID = User::find($trans->user_id);
           $rtnMesssage = $this->creditUser($userID,$trans->amount);
        $trans->delete();
          }
   
      return redirect(route('manager.Ptransactions'))->with('success','All Transactions Successfully Updated');

     }


    public function updateUserWallet($transType,User $userID,Request $request){

          if($transType == "credit"){
            $rtnMesssage = $this->creditUser($userID,$request->amount,$request->narration);
            return redirect(route('manager.usersWallet'))->with('success',$rtnMesssage);
          }else{

            $rtnMesssage = $this->debitUser($userID,$request->amount,$request->narration);
            return redirect(route('manager.usersWallet'))->with('success',$rtnMesssage);


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
    return redirect(route('manager.users') )->with('error', 'User Account has been deleted');
   }

   public function deleteRep( Rep $rep
       )
       {
       $rep->delete();
       return redirect(route('manager.reps') )->with('error', 'Rep Account has been deleted');
      }

}
