<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event\userCreated;
class SchoolsController extends Controller
{
    //

      public function index(){

        $rtn =   event (new userCreated('developerafo'));
        $splitted  = $rtn[0];
        return  redirect(route('smyl.login'))->with('greet',$splitted);
      }

      public function apiTest(){

        $mynumber = '1002021001';
       echo substr($mynumber, 0,3);
       echo "<br/>";
       $num = 'BS/100/M';
       echo substr($num, 3,3);
   // echo date("d/m/Y h:i A");
     }

     public function apiTesttwo(){
          $message = "DEVELOPER AFO\nAccount Num:222\nby INTELLIC SOLUTION"."\n"."https://intellicsolutions.com";
        $request = "";
        $param["api_token"] = "72eA3YKF8cjJoLAFWoeB7QGWuwugsq83M2kIeboS0T7bqSFP4Ms9WNgho4KK";
        $param["from"] = "SMYL";
        $param["to"] =  "08176192995";
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


      $result = json_decode($response);


    $status = $result->data->status;
     echo $status;
     if($status == "success"){
       echo "sent";
     }else{
       echo "failed";
     }

   }

}
