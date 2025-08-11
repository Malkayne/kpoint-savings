@extends('managerend.layout')
@section('bodyContent')

<div class="row align-items-center justify-content-between">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <div class="card">
        <div class="card-header">
                    <h3 class="card-title">Pending User Credits for {{ App\Models\User::find($userID)->firstName }} (Total Amount => <del>N</del> {{ $Ptransactions->sum('amount') }} )
                         <button style="padding:5px;margin:10px 10px 10px 20px" class="btn btn-outline btn-sm btn-success"><a class="text-white" href="/admin/approveAllUserCredits/{{$userID}}">Approve All <i class="fa fa-check-square" aria-hidden="true"></i>
                           </a></button>
                  </div>
     <div class="card-body table-responsive">


       <table id="setsubdatatable" class="table table-bordered table-stripped" id="dataTable"  width="100%" cellspacing="0">
          <thead class="bg bg-success text-white">
            <tr>
              <!-- <th style="width: 10px">#</th> -->
              <th>#</th>
              <th>Username</th>
              <th>Account Number</th>
              <th >Amount</th>
              <th>Transaction type</th>
              <th>Date and Time</th>
              <th>Rep Name</th>
              <th colspan="2">Action</th>
            </tr>
          </thead>
          <tbody>

             @foreach($Ptransactions as $key => $Ptransaction)
            <tr>
                   <td>{{ $key+1 }}</td>
              <td>{{ $Ptransaction->user->firstName }}</td>
             <td>{{ $Ptransaction->user->accNum }}</td>
              <td><del>N</del>{{ number_format($Ptransaction->amount) }}</td>

              <td>{{$Ptransaction->transType }}</td>
              <td>{{ $Ptransaction->created_at }}</td>
              @if($Ptransaction->rep_id !== null)
              <th>{{ App\Models\Rep::find($Ptransaction->rep_id)->name }}</th>
              @else
           <th>NULL</th>
              @endif
                <td colspan="2">
                  <button style="padding:5px;margin:10px" class="btn btn-outline btn-sm btn-success"><a class="text-white" href="/admin/approveCredit/{{ $Ptransaction->id }}"><i class="fa fa-check-square" aria-hidden="true"></i></a></button>
                  
                                    <button style="padding:5px;margin:10px" class="btn btn-outline btn-sm btn-danger"><a class="text-white" href="/admin/disApproveCredit/{{ $Ptransaction->id }}"><i class="fa fa-trash" aria-hidden="true"></i>
                    </a></button>
                    
                </td>
            </tr>
@endforeach


          </tbody>
           <tfoot>
             <tr>

               <th>#</th>
               <th>Username</th>
               <th>Account Number</th>
               <th >Amount</th>
               <th>Transaction type</th>
               <th>Date and Time</th>
               <th>Rep Name</th>
               <th colspan="2">Action</th>
             </tr>
            </tfoot>
        </table>
      </div>

    </div>
    </div>
    <!-- /.card -->

</div>

@endsection
