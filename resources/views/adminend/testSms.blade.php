@extends('adminend.layout')

@section('bodyContent')

@if ($message = Session::get('success'))
      <center>
      <div class="row d-flex justify-content-center" style="margin-top:5px">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
          <div class="alert alert-success alert-dismissble">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ $message }}
          </div>
        </div>
        <div class="col-md-3">
        </div>
      </div>
    </center>
    @endif

    @if ($message = Session::get('error'))
          <center>
          <div class="row d-flex justify-content-center" style="margin-top:5px">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
              <div class="alert alert-danger alert-dismissble">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ $message }}
              </div>
            </div>
            <div class="col-md-3">
            </div>
          </div>
        </center>
        @endif


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
              <center> <h2 class="card-title">Send Message</h2> </center>
             </div>
             <!-- /.card-header -->
             <!-- form start -->
             <form  action="{{ route('admin.testSms')}}" method="post">
               @csrf
               <div class="card-body">
                   
                 <div class="form-group">
                   <label for="exampleInputEmail1">Phone Number</label>
                   <input type="number" name="numb" class="form-control" id="exampleInputEmail1" value="" >
                 </div>


                                 
                                    <div class="form-group">
                   <label for="exampleInputEmail1">Message</label>
                   <!--<input type="email" name="narration" class="form-control" id="exampleInputEmail1" >-->
                   <textarea name="message" placeholder="narration" class="form-control"></textarea>
                 </div>
  <br/>

               </div>
               <!-- /.card-body -->

               <div class="card-footer">
                 <button type="submit" class="btn btn-success" > Send</button>
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
