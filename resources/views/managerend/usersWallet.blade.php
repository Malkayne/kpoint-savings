@extends('managerend.layout')
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

<div class="row align-items-center justify-content-between">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <div class="card">
     <div class="card-body table-responsive">
       <!--<h3 class="card-title">DATA TABLE  FOR TRANSACTIONS</h3>-->

       <table id="setsubdatatable" class="table table-bordered table-stripped" id="dataTable"  width="100%" cellspacing="0">

          <thead class="bg bg-success text-white">
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Account Number</th>
              <th >Amount</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          @foreach($users as $key => $user)
            <tr>
              <td>{{ $key+1 }}</td>
              <td>{{ $user->firstName.' '.$user->lastName}}</td>
              <td>{{ $user->accNum }}</td>
              <td><del>N</del>{{ $user->wallet->amount??'0.00' }}</td>

              <td> <button style="padding:5px;margin:10px" class="btn btn-outline btn-sm btn-success"><a class="text-white" href="{{ route('manager.user',['transType'=> 'credit','userID' => $user->id])}}"><i class="fa fa-plus-square" aria-hidden="true"></i></a></button>
             <button style="padding:5px;margin:10px" class="btn btn-outline btn-sm btn-danger"><a class="text-white" href="{{ route('manager.user',['transType'=> 'debit','userID' => $user->id])}}"><i class="fa fa-minus-square" aria-hidden="true"></i></a></button> </td>

            </tr>
@endforeach

          </tbody>
           <tfoot>
             <tr>
               <th>#</th>
               <th>Name</th>
               <th>Account Number</th>
               <th >Amount</th>
               <th>Action</th>
             </tr>
            </tfoot>
        </table>
      </div>

    </div>
    </div>
    <!-- /.card -->

</div>

@endsection
