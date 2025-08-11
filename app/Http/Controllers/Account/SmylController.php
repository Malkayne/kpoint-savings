<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SmylController extends Controller
{

    public function index(){

  return view('smyl.dashboard',['title'=>'dashboard']);

     }


    public function profile(){
      return view('smyl.profile',['title'=>'Profile']);
    }

    public function editProfile(User $user){

      return view('smyl.editProfile',['userDetails'=> $user,'title'=>'Update Profile']);

    }

    public function updateProfile(Request $request,User $userID){

        $userID->update($request->all());

      return redirect(route('smyl.profile'))->with('success','Your Profile has been Successfully updated');

    }



    public function wallet(){
      return view('smyl.wallet');
    }

    public function transactions(){

      return view('smyl.transactions');
    }

    public function contact(){
      return view('smyl.dashboard');
    }

    public function documentation(){
      return view('smyl.documentation');
    }
    
    //FIRST SMS SENDER

private function smssender($numb,$message){

  $request = "";
  $param["api_token"] = "k3JXHTyCXv7utY4WJavoI0C4r830luhKmyi5U1E4tFVBpO0xi8X8Eobhh0fK";

  $param["from"] = "SMYL";
  $param["to"] =  $numb;
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

//SECOND SMS SENDER

private function sendsmstwo($number,$message){



// Initialize variables ( set your variables here )

$username = 'benesomed@gmail.com';

$password = 'Febr1991/bulksms2';

$sender   = 'SMYL';


// Set your domain's API URL

$api_url  = 'https://portal.nigeriabulksms.com/api/';


//Create the message data

$data = array('username'=>$username, 'password'=>$password, 'sender'=>$sender, 'message'=>$message, 'mobiles'=>$number);

//URL encode the message data

$data = http_build_query($data);

//Send the message

$ch = curl_init(); // Initialize a cURL connection

curl_setopt($ch,CURLOPT_URL, $api_url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_POST, true);
curl_setopt($ch,CURLOPT_POSTFIELDS, $data);

$result = curl_exec($ch);

$result = json_decode($result);


if(isset($result->status) && strtoupper($result->status) == 'OK')
{
    // Message sent successfully, do anything here
     return true;
}
else if(isset($result->error))
{
     // Message failed, check reason.
   return false;

}
else
{

  return false;
}

   }
   
   // SMS FUNCTION FOR TRYING DIFFERENT SMS PROVIDER
   private function smsprocessor($numb,$meesage)
   {
           $sendsms = $this->smssender($numb,$meesage);
           if($sendsms !== FALSE){
            return true;   
           }else{
          $sendsmstwo = $this->sendsmstwo($numb,$meesage);
           if($sendsmstwo !== FALSE){
             return true;  
           }else{
             return false;  
           }
           }
       
   }

    public function getPin(){
        $user = User::find(auth::user('user')->id);
        $pin = rand(1000,9999);
        $name = $user->firstName.' '.$user->lastName;
        $numb = $user->phoneNumber;
        $user->pin = $pin;
       $savor =  $user->save();
       
       if($savor){
            $message = "Dear ".$name."\n Your transaction pin is ".$pin.".\nNOTE: Do not share pin with anyone.";
          // $sendsms = $this->smssender($name,$numb,$pin);
           $sendsmstwo = $this->smsprocessor($numb,$message);
           if($sendsmstwo){
              
          return redirect()->back()->with("success","your pin has been successfully generated and sent to your registered number.");
          
           }else{
        return redirect()->back()->with("error","Something went wrong,please try again");  
           }
       }else{
         return redirect()->back()->with("error","Something went wrong,please try again");
       }
    }

    private function validatePin($pin){
      $upin = Auth::user('user') ->pin;
      if($upin == $pin){
          return true;
      }else{
          return false;
      }
     }

   public function airtime(){
      return view('smyl.airtime');
    }
    
   public function pairtime(Request $request){
       
       if($request->has('pin')){
           if($this->validatePin($request->pin) !== FALSE){
              
              
              $user = User::where('pin',$request->pin)->first();
              
              if(empty($user)){
                return redirect()->back()->with("error","Invalid Pin");
              }
               
            $numb = Auth::user('user') ->phoneNumber;
            $acc = Auth::user('user') ->accNum;
            $name = $user->firstName.' '.$user->lastName;
            
            //  $usermessage = "Dear ".$name."\n Your N".$request->amount." airtime purchase is been processed.\nYou would get it in the next five minute";
            
            $usermessage = "Your request is being processed";
            
            $adminmessage = "Airtime Purchase\nAccount Number:".$acc."\nDetails\nNetwork:".$request->network."\nAmount:".$request->amount."\nBeneficiary:".$request->benf;
            $adminNumb = '09038472927';
           $adminSebder = $this->smsprocessor($adminNumb,$adminmessage);
            $sender = $this->smsprocessor($numb,$usermessage);
             if($sender !== FALSE){
        return redirect()->back()->with("success","Your request is being processed"); 
             }else{
            return redirect()->back()->with("error","Something went wrong,please try again");
             }
             
           }else{
      return redirect()->back()->with("error","invalide pin");  
           }
       }else{
        return redirect()->back()->with("error","your pin is required");  
       }
      //return view('smyl.airtime');
    }


       public function data(){
      return view('smyl.data');
    }
    
    
    public function pdata(Request $request){
       
       if($request->has('pin')){
           if($this->validatePin($request->pin) !== FALSE){
               
                 $user = User::where('pin',$request->pin)->first();
              
              if(empty($user)){
                return redirect()->back()->with("error","Invalid Pin");
              }
               
            $numb = $user->phoneNumber;
            $acc = $user->accNum;
            $name = $user->firstName.' '.$user->lastName;
            
        // $usermessage = "Dear ".$name."\n Your N".$request->amount." data purchase is been processed.\nYou would get it in the next five minute";
            
           $usermessage = "Your request is being processed";
            
            $adminmessage = "Data Purchase\nAccount Number:".$acc."\nDetails\nNetwork:".$request->network."\nAmount:".$request->amount."\nBeneficiary:".$request->benf;
            $adminNumb = '08166035923';
            $sender = $this->smsprocessor($numb,$usermessage);
             if($sender !== FALSE){
                 $this->smsprocessor($adminNumb,$adminmessage);
        return redirect()->back()->with("success","Processing request"); 
             }else{
            return redirect()->back()->with("error","Something went wrong,please try again");
             }
             
           }else{
      return redirect()->back()->with("error","invalide pin");  
           }
       }else{
        return redirect()->back()->with("error","your pin is required");  
       }
      
    }
    
       public function phcn(){
      return view('smyl.phcn');
    }
    
    
    public function pphcn(Request $request){
       
       if($request->has('pin')){
           if($this->validatePin($request->pin) !== FALSE){
               
                 $user = User::where('pin',$request->pin)->first();
              
              if(empty($user)){
                return redirect()->back()->with("error","Invalid Pin");
              }
              
            $numb = $user->phoneNumber;
            $acc = $user->accNum;
            $name = $user->firstName.' '.$user->lastName;
            
        // $usermessage = "Dear ".$name."\n Your phcn subscribtion is been processed.\nYou would get notified in the next five minute";
            
          $usermessage = "Your request is being processed";

            $adminmessage = "PHCN\nAccount Number:".$acc."\nDetails\nPhcn Company:".$request->phcnComp."\nMeter Number:".$request->meterNumb."\nAmount:".$request->amount;
            $adminNumb = '08166035923';
            $sender = $this->smsprocessor($numb,$usermessage);
             if($sender !== FALSE){
                 $this->smsprocessor($adminNumb,$adminmessage);
        return redirect()->back()->with("success","Processing request");
             }else{
            return redirect()->back()->with("error","Something went wrong,please try again");
             }
             
           }else{
      return redirect()->back()->with("error","invalide pin");  
           }
       }else{
        return redirect()->back()->with("error","your pin is required");  
       }
      
    }
    
       public function bankTransfer(){
      return view('smyl.bankTransfer');
    }
    
    
        public function pbankTransfer(Request $request){
       
       if($request->has('pin')){
           if($this->validatePin($request->pin) !== FALSE){
             
               $user = User::where('pin',$request->pin)->first();
              
              if(empty($user)){
                return redirect()->back()->with("error","Invalid Pin");
              }
             
            $numb = $user->phoneNumber;
            $acc = $user->accNum;
            $name = $user->firstName.' '.$user->lastName;
            
        // $usermessage = "Dear ".$name."\n Your bank tranfers is been processed.\nYou would get notified in the next five minute";
            
                        $usermessage = "Your request is being processed";

            $adminmessage = "Bank Transfer\nSMYL ACCOUNT NUMB: ".$acc."\nDetails\nAccount Number:".$request->accNumb."\nAccount Name:".$request->accName."\nBank Name:".$request->bankName."\nAmount:".$request->amount;
            $adminNumb = '08166035923';
            $sender = $this->smsprocessor($numb,$usermessage);
             if($sender !== FALSE){
                 $this->smsprocessor($adminNumb,$adminmessage);
        return redirect()->back()->with("success","Processing Request");
             }else{
            return redirect()->back()->with("error","Something went wrong,please try again");
             }
             
           }else{
      return redirect()->back()->with("error","invalide pin");  
           }
       }else{
        return redirect()->back()->with("error","your pin is required");  
       }
      
    }
    
    public function tvsub(){
      return view('smyl.tvsub');
    }
    
    
    
    public function ptvsub(Request $request){
       
       if($request->has('pin')){
           if($this->validatePin($request->pin) !== FALSE){
               
                 $user = User::where('pin',$request->pin)->first();
              
              if(empty($user)){
                return redirect()->back()->with("error","Invalid Pin");
              }
               
            $numb = $user->phoneNumber;
            $acc = $user->accNum;
            $name = $user->firstName.' '.$user->lastName;
            
        // $usermessage = "Dear ".$name."\n Your bank tranfers is been processed.\nYou would get notified in the next five minute";
            
                        $usermessage = "Your request is being processed";

            $adminmessage = "Bank Transfer\nSMYL ACCOUNT NUMB: ".$acc."\nDetails\TV Type:".$request->tvtype."\nType Name:".$request->typename."\nDecoder Name:".$request->decodername."\nPhone Number:".$request->number;
            
            $adminNumb = '08166035923';
            $sender = $this->smsprocessor($numb,$usermessage);
             if($sender !== FALSE){
                 $this->smsprocessor($adminNumb,$adminmessage);
        return redirect()->back()->with("success","Processing Request");
             }else{
            return redirect()->back()->with("error","Something went wrong,please try again");
             }
             
           }else{
      return redirect()->back()->with("error","invalide pin");  
           }
       }else{
        return redirect()->back()->with("error","your pin is required");  
       }
      
    }

}
