@extends('smyl.layout')

@section('bodyContent')


<section class="content">
     <div class="container-fluid">
       <div class="row">
              <div class="col-md-2">
              </div>
         <!-- left column -->
         <div class="col-md-8">
             @if(Auth::user('user')->pin == null)
             <div class="alert alert-warning" role="alert">
             <a href="/smyl/get-pin" style="text-decoration:none">Click here to generate pin <button type="button" style="margin-left:30px" class="btn btn-light">generate Pin</button>
            </a>
            </div>
            
            <div class="alert alert-danger" role="alert">
             <b>Note:</b>This pin would be sent to your registered number.<br/> 
             Do not share this pin with anyone,as it would be used to validate your transactions
             </div>
             @endif
           <!-- general form elements -->
           <div class="card card-success">
             <div class="card-header">
              <center> <h2 class="card-title">TV SUB</h2> </center>
             </div>
             <!-- /.card-header -->
             <!-- form start -->
             <form  action="{{ route('smyl.tvsub')}}" method="post">
               @csrf
               <div class="card-body">
             
                 <div class="form-group">
                   <label for="exampleInputEmail1">Wallet Balance</label>
                   <div class="input-group">
                   <div class="input-group-prepend">
                     <span class="input-group-text"><del>N</del></span>
                   </div>
                   <input type="number" name="walletBalance" class="form-control" id="exampleInputEmail1" readonly value="{{ auth::user('user')->wallet->amount??0 }}" >
                   <div class="input-group-append">
                     <span class="input-group-text">.00</span>
                   </div>
                 </div>
                 </div>
                 
             <div class="form-group">
               <label for="exampleInputEmail1">Pin</label>
              <input type="text" name="pin" class="form-control" placeholder="input your pin" required>
             </div>
                 
                      <div class="form-group">
               <label for="exampleInputEmail1">TV Type</label>
             <select name="tvtype" required class="form-control">
                 <option>GOTV</option>
                <option>DSTV</option>
                 <option>STARTIMES</option>
             </select>
             </div>     
             
                     <div class="form-group">
               <label for="exampleInputEmail1">TV Type Name</label>
              <input type="text"  name="typename" class="form-control"  required>
             </div> 
                  
              
                <div class="form-group">
               <label for="exampleInputEmail1">Decoder Number</label>
              <input type="number"  name="decodername" class="form-control"  required>
             </div> 
                  
         <div class="form-group">
               <label for="exampleInputEmail1">Phone Number</label>
              <input type="number"  name="number" class="form-control"  required>
             </div>   


               </div>
               <!-- /.card-body -->

               <div class="card-footer">
                 <button type="submit" class="btn btn-success"> Submit </button>
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
