@extends('managerend.layout')

@section('bodyContent')


<section class="content">
     <div class="container-fluid">
       <div class="row">
              <div class="col-md-2">
              </div>
         <!-- left column -->
         <div class="col-md-8">
           <!-- general form elements -->
           <div class="card card-success">
             <div class="card-header">
              <center> <h2 class="card-title">{{ ucFirst($transType) }} User</h2> </center>
             </div>
             <!-- /.card-header -->
             <!-- form start -->
             <form  action="{{ route('manager.updateUserWallet',['transType' => $transType,'userID' => $user->id])}}" method="post">
               @csrf
               <div class="card-body">
                 <div class="form-group">
                   <label for="exampleInputEmail1">Name</label>
                   <input type="email" name="name" class="form-control" id="exampleInputEmail1" readonly value="{{ $user->firstName.' '.$user->lastName}}" >
                 </div>


                 <div class="form-group">
                   <label for="exampleInputEmail1">Account Number</label>
                   <input type="number" name="user_pin" class="form-control" id="exampleInputEmail1" readonly value="{{ $user->accNum }}" >
                 </div>

                 <div class="form-group">
                   <label for="exampleInputEmail1">Wallet Balance</label>
                   <div class="input-group">
                   <div class="input-group-prepend">
                     <span class="input-group-text"><del>N</del></span>
                   </div>
                   <input type="number" name="walletBalance" class="form-control" id="exampleInputEmail1" readonly value="{{ $user->wallet->amount??0 }}" >
                   <div class="input-group-append">
                     <span class="input-group-text">.00</span>
                   </div>
                 </div>
                 </div>

      <div class="input-group">
                                   <div class="input-group-prepend">
                                     <span class="input-group-text"><del>N</del></span>
                                   </div>
                                   <input type="number" class="form-control" name="amount"onkeypress="return isNumberKey(event)">
                                   <div class="input-group-append">
                                     <span class="input-group-text">.00</span>
                                   </div>
                                 </div>
                                 <script>
                                 // if( charCode > 38 && ( charCode !=46 && (charCode < 48 || charCode > 57) ) )
                                 function isNumberKey(evt){
                                   var charCode = (evt.which)?evt.which:evt.keyCode
                                   if( charCode > 38 && (charCode < 48 || charCode > 57 ) )
                                   return false;
                                   return true;
                                 }
                                 </script>
                                 
                                    <div class="form-group">
                   <label for="exampleInputEmail1">Narration</label>
                   <!--<input type="email" name="narration" class="form-control" id="exampleInputEmail1" >-->
                   <textarea name="narration" placeholder="narration" class="form-control"></textarea>
                 </div>
  <br/>

               </div>
               <!-- /.card-body -->

               <div class="card-footer">
                 <button type="submit" class="btn btn-success" > {{ ucFirst( $transType  )}}</button>
               </div>
             </form>
           </div>
         </div>

           <div class="col-md-2">
           </div>

         </div>
       </div>
</section>

@endsection
