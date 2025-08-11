@extends('repEnd.layout')
@section('bodyContent')

<div class="row align-items-center justify-content-between">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <div class="card">
        <div class="card-header">
                    <h3 class="card-title">Pending Credits (Total Amount => <del>N</del> {{ $Ptransactions->sum('amount') }} )
                  </div>
     <div class="card-body table-responsive">
       <!--<h3 class="card-title">DATA TABLE  FOR TRANSACTIONS</h3>-->

       <table id="setsubdatatable" class="table table-bordered table-stripped" id="dataTable"  width="100%" cellspacing="0">
          <thead class="bg bg-success text-white">
            <tr>
              <!-- <th style="width: 10px">#</th> -->
              <th>#</th>
              <th>Name</th>
              <th >Amount</th>
              <th>Transaction type</th>
              <th>Date and Time</th>
            </tr>
          </thead>
          <tbody>

             @foreach($Ptransactions as $key => $Ptransaction)
            <tr>
                   <td>{{ $key+1 }}</td>
              <td>{{ $Ptransaction->user->firstName }}</td>
              <td><del>N</del>{{ number_format($Ptransaction->amount) }}</td>

              <td>{{$Ptransaction->transType }}</td>
              <td>{{ $Ptransaction->created_at }}</td>
             
            </tr>
@endforeach


          </tbody>
           <tfoot>
             <tr>

               <th>#</th>
               <th>Name</th>
               <th >Amount</th>
               <th>Transaction type</th>
               <th>Date and Time</th>
             </tr>
            </tfoot>
        </table>
      </div>

    </div>
    </div>
    <!-- /.card -->

</div>

@endsection
