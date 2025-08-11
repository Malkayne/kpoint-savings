@extends('managerend.layout')
@section('bodyContent')

<div class="row align-items-center justify-content-between">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <div class="card">
     <div class="card-body table-responsive">
       <!--<h3 class="card-title">DATA TABLE  FOR TRANSACTIONS</h3>-->

       <table id="setsubdatatable" class="table table-bordered table-stripped" id="dataTable"  width="100%" cellspacing="0">
          <thead class="bg bg-success text-white">
            <tr>
              <!-- <th style="width: 10px">#</th> -->
              <th>#</th>
              <th >Amount</th>
              <th>Transaction Type</th>
              <th>Date and Time</th>
              <th>Reference Key</th>
              <th>About Transaction</th>
            </tr>
          </thead>
          <tbody>

             @foreach($transactions as  $key=>$transaction)
            <tr>
              <td>{{ $key+1 }}</td>

              <td><del>N</del>{{ number_format($transaction->amount) }}</td>

              <td>{{$transaction->transType }}</td>
              <td>{{ $transaction->created_at }}</td>
              <td>{{ $transaction->refKey }}</td>

              <td>{{ $transaction->about }}</td>
            </tr>
@endforeach


          </tbody>
           <tfoot>
             <tr>
               <th>#</th>
              <th >Amount</th>
              <th>Transaction Type</th>
              <th>Date and Time</th>
              <th>Reference Key</th>
              <th>About Transaction</th>
             </tr>
            </tfoot>
        </table>
      </div>

    </div>
    </div>
    <!-- /.card -->

</div>

@endsection
